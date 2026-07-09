<?php
include "db_connect.php";
$departments = $conn->query("
    SELECT 
        d.DepartmentsId,
        d.DepartmentName,
        (
    SELECT c.CampaignId
    FROM campaigns c
    WHERE c.TargetDepartmentId = d.DepartmentsId
    ORDER BY c.CampaignId DESC
    LIMIT 1
) AS LastCampaign

    FROM departments d
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> View Report</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .card-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
    padding: 20px;
    width: 90%;
    margin: auto;
}

.report-card {
    background: #021939;
    color: #ffffff;
    padding: 18px;
    border-radius: 14px;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.3);
    cursor: pointer;
    transition: 0.3s;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    height: 160px;
}

.card-left {
    flex: 1;
    padding-left: 10px;
}

.card-left h3 {
    margin: 0;
    font-size: 20px;
}

.score-text {
    margin-top: 8px;
    font-size: 16px;
}

.card-right {
    width: 130px;
    height: 130px;
    margin-right: 10px;
}

.card-right canvas {
    width: 130px !important;
    height: 130px !important;
}

.pending-card {
    background: #4a4a4a !important; /* رمادي غامق ناعم */
    opacity: 0.5; /* يوضح أنه غير نشط */
    cursor: default !important;
}

.pending-card .score-text {
    color: #ddd !important;
}

.pending-card h3 {
    color: #fff !important;
}
</style>

</head>
<body>
 <div class="navbar">

        <img class="logo" src="imge\Group 4.svg" alt="logo" width="20px">
        <ul class="nav-item">
            <li class="link">
                <a href="index.php">Home</a>
            </li>
            <li class="link">
                <a href="signuppage.php">join us</a>
            </li>
            <a href="Administrator.php" class="back-icon-btn">
                <svg class="back-icon" viewBox="0 0 24 24">
                    <path d="M9 6l6 6-6 6" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
    </div>
    <!-- nav close -->


<h2 style="color:white; text-align:center; margin-top:75px;">📊 Awareness Level by Department</h2>
<div class="card-container">

<?php 
$index = 1;

while($row = $departments->fetch_assoc()):
    $deptId = $row["DepartmentsId"];
$deptName = $row["DepartmentName"];
$campaignId = $row["LastCampaign"]; 

    $reported = 0;
    $clicked = 0;
    $ignored = 0;

    if ($campaignId !== null) {
        $stats = $conn->query("
            SELECT 
                COUNT(*) AS total,
                SUM(ReportedStatus=1) AS reported,
                SUM(FailureStatus=1) AS clicked
            FROM result
            WHERE CampaignId = $campaignId
        ")->fetch_assoc();

        $reported = $stats["reported"];
        $clicked = $stats["clicked"];
        $ignored = $stats["total"] - $reported - $clicked;
    }
?>
<div class="report-card <?= ($campaignId === null ? 'pending-card' : '') ?>" 
     <?= ($campaignId === null ? '' : "onclick=\"loadDetails('$campaignId', '$deptName')\"") ?>>

    <?php if ($campaignId === null): ?> 
         <div class="card-left">
            <h3><?= $deptName ?></h3>
            <p class="score-text" style="color:#ccc;">Pending — No campaigns yet</p>
        </div>

        <div class="card-right" style="opacity:0.3;">
            <canvas id="chart<?= $index ?>" style="display:none;"></canvas>
        </div>

    <?php else: ?>
        <div class="card-left">
            <h3><?= $deptName ?></h3>

            <?php 
                $total = $reported + $clicked + $ignored;
                $score = ($total > 0) ? round(($reported / $total) * 100) : 0;

                $chartData[$index] = [
                    'reported' => $reported,
                    'clicked'  => $clicked,
                    'ignored'  => $ignored
                ];
            ?>
            <p class="score-text">Awareness Level: <strong><?= $score ?>%</strong></p>
        </div>

        <div class="card-right">
            <canvas id="chart<?= $index ?>"></canvas>
        </div>
    <?php endif; ?>

</div>
<?php 
$index++;
endwhile;
?>

</div>

<div id="employee-details"></div>

<script>
function loadDetails(campaignId, deptName) {

    if (campaignId === "null") {
        document.getElementById("employee-details").innerHTML = `
            <h2 style="text-align:center; color:white;">📄 ${deptName}</h2>
            <p style="text-align:center; padding:20px; font-size:18px; color:white;">
                ⛔ There is no campaign for this section yet            </p>
        `;
        return;
    }

    fetch("report_details.php?cid=" + campaignId)
    .then(res => res.text())
    .then(data => {

        document.getElementById("employee-details").innerHTML = `
            <div style="text-align:center; margin-bottom:15px;">
                <h2 style="color:white;">📄 Employees — ${deptName}</h2>

                <button onclick="printSection('${deptName}')"
                    style="
                        background:#021939;
                        color:white;
                        padding:10px 18px;
                        border:none;
                        border-radius:8px;
                        cursor:pointer;
                        margin-top:-80px;
                        font-size:16px;
                    ">
                    🖨️ Print Report
                </button>
            </div>

            <div id="print-area" >
             ${data}
            </div>

        `;

        window.scrollTo({ top: 400, behavior: "smooth" });
    });
}
</script>

<script>
<?php foreach ($chartData as $i => $values): ?>
new Chart(document.getElementById("chart<?= $i ?>"), {
    type: "pie",
    data: {
        labels: ["Reported", "Clicked", "Ignored"],
        datasets: [{
            data: [
                <?= $values['reported'] ?>, 
                <?= $values['clicked'] ?>, 
                <?= $values['ignored'] ?>
            ],
            backgroundColor: ["#4CAF50", "#E53935", "#90A4AE"]
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: { display: false }
        }
    }
});
<?php endforeach; ?>
</script>
<script>
function printSection(deptName) {

    var printContents = document.getElementById("print-area").innerHTML;

    var printWindow = window.open('', '', 'height=900,width=800');

    printWindow.document.write(`
        <html>
        <head>
            <title>Awareness Report - ${deptName}</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }

                .header {
                    text-align: center;
                    padding-bottom: 20px;
                    margin-bottom: 20px;
                    border-bottom: 3px solid #021939;
                }

                .header img {
                    width: 120px;
                    margin-bottom: 10px;
                }

                .header h1 {
                    color: #021939;
                    margin: 0;
                    font-size: 26px;
                }

                .header h3 {
                    color: #333;
                    margin: 5px 0;
                    font-weight: normal;
                }

                table {
                width:100%;
                 table-layout: auto;
 
                border-collapse: collapse; 
                text-align:center; 
                font-size: 16px;"
                marain-button:30%;

                }

                th, td {
                    border: 1px solid #333;
                    padding: 12px;
                    text-align: center;
                    white-space: nowrap;   
                }

                th {
                    background: #021939;
                    color: white;
                }

                td {
                    background: #ffffff;
                }

            </style>
        </head>

        <body>

            <div class="header">
                <img src="imge/Group 4.svg" alt="Cyber Shield Logo">
                <h1>Cyber Shield Platform</h1>
                <h3>Awareness Report — ${deptName}</h3>
            </div>

            ${printContents}

        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.print();
}
</script>

</body>
</html>
