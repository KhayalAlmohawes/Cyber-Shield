<?php
session_start();
include 'db_connect.php';


$campaignTypes = [];
$res = $conn->query("SELECT * FROM campaigntype");
while ($row = $res->fetch_assoc()) {
    $campaignTypes[] = $row;
}


$departments = [];
$res2 = $conn->query("SELECT * FROM departments");
while ($row = $res2->fetch_assoc()) {
    $departments[] = $row;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $campaignTypeId = $_POST['campaign_type'] ?? "";
    $departmentId   = $_POST['department_id'] ?? "";
    $campaignTime   = $_POST['campaignTime'] ?? "";

    $adminId = $_SESSION['user_id'] ?? 11;  

    if ($campaignTypeId == ""  || $departmentId == ""  || $campaignTime == "") {
        die("❌ Please fill out all fields");
    }

    
    $stmtTemp = $conn->prepare("SELECT TemplateId FROM templates WHERE CampaignTypeId = ? LIMIT 1");
    $stmtTemp->bind_param("i", $campaignTypeId);
    $stmtTemp->execute();
    $resultTemp = $stmtTemp->get_result();

    if ($resultTemp->num_rows == 0) {
        die("⚠️ There is no Template for this type");
    }

    $templateId = $resultTemp->fetch_assoc()["TemplateId"];

    
    $status  = "Active";
    $details = "Campaign launched";

    $insert = $conn->prepare("
        INSERT INTO campaigns
        (TemplateId, TargetDepartmentId, LaunchDate, AdminId, status, CampaignDetails)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $insert->bind_param(
        "iisiss",
        $templateId,
        $departmentId,
        $campaignTime,
        $adminId,
        $status,
        $details
    );

    if ($insert->execute()) {

        $campaignId = $conn->insert_id;

        header("Location: send_mail.php?campaign=$campaignId");
        exit;
    } else {
        die("❌ Error saving campaign " . $insert->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Launch page</title>
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>

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

    </div><!-- nav close -->


    <H1 class="sentencs">Launch Campaign <br><span class="green">Empower </span>employees with every <span class="blue">campaign</span></H1>

    <form method="POST">

        <div class="form-container">

            <select class="select-box" name="campaign_type" required>
                <option disabled selected>Campaign Type</option>
                <?php foreach ($campaignTypes as $c): ?>
                    <option value="<?= $c['CampaignTypeId'] ?>"><?= $c['CampaignTypeName'] ?></option>
                <?php endforeach; ?>
            </select>

            <select class="select-box" name="department_id" required>
                <option disabled selected>Target Department</option>
                <?php foreach ($departments as $d): ?>
                    <option value="<?= $d['DepartmentsId'] ?>"><?= $d['DepartmentName'] ?></option>
                <?php endforeach; ?>
            </select>

            <input class="select-box" type="datetime-local" name="campaignTime" required>

        </div>

        <button class="Lunch" type="submit">Launch</button>
    </form>
    <div class="footer">
        <img class="logo-footer" src="imge\logofotter.svg" alt="logo" width="60">

        <ul class="footer-item">
            <li class="link-footer">
                <img src="imge\call.svg" width="30px">
                <a href="0501092200">0501092200</a>
            </li>
            <li class="link-footer">
                <img src="imge\email icon.svg" width="30px">
                <a href="mailto:cybershield.platform@gmail.com">cybershield.platform</a>
            </li>

            <li class="link-footer">
                <a href="policy.html">privacy policy</a>
            </li>
            <li class="link-footer">
                <a href="Terms&conditions.html">Terms&conditions</a>
            </li>
        </ul>
    </div>
    <!-- jc -->
    <script src="main.js"></script>
</body>