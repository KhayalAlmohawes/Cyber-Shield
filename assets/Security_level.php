<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "db_connect.php";
$user_id = $_SESSION['user_id'] ?? 0;

$getLevel = $conn->prepare("SELECT AwarenessLevel FROM members WHERE MemberId = ?");
$getLevel->bind_param("i", $user_id);
$getLevel->execute();
$levelFromDB = $getLevel->get_result()->fetch_assoc()['AwarenessLevel'] ?? 30;
if (isset($_GET['fetch_data'])) {

    $user_id = $_SESSION['user_id'] ?? 0;

    $sql1 = "SELECT SUM(ReportedStatus) AS reported FROM result WHERE MemberId = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $user_id);
    $stmt1->execute();
    $reported = intval($stmt1->get_result()->fetch_assoc()['reported'] ?? 0);



    $sql2 = "SELECT SUM(FailureStatus) AS clicked FROM result WHERE MemberId = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $clicked = intval($stmt2->get_result()->fetch_assoc()['clicked'] ?? 0);


    $sql3 = "SELECT COUNT(*) AS total FROM campaigns WHERE TargetDepartmentId = (SELECT DepartmentId FROM members WHERE MemberId = ?)";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("i", $user_id);
    $stmt3->execute();
    $total_campaigns = intval($stmt3->get_result()->fetch_assoc()['total'] ?? 0);


    $ignored = max(0, $total_campaigns - ($reported + $clicked));

   echo json_encode([
    "reported"  => $reported,
    "clicked"   => $clicked,
    "ignored"   => $ignored,
    "baseLevel" => $levelFromDB
]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- css -->
 <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8" />
  <title>Security Awareness Level</title>
<style>.back-icon-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border: 1.5px solid rgba(255,255,255,0.28);
    border-radius: 50%;
    margin-right: 14px;
    cursor: pointer;
    transition: 0.25s;
}

.back-icon-btn:hover {
    border-color: rgba(255,255,255,0.55);
    transform: translateX(-3px);
}

.back-icon {
    width: 18px;
    height: 18px;
}</style>
</head>
<body>
<div class="navbar">
<img class="logo" src="imge\Group 4.svg"alt="logo"width="20px">
<ul class="nav-item">
<li class="link" >
<a href="index.php">Home</a>  
</li>
<li class="link">
<a href="signuppage.php">join us</a>  
</li>
 <a href="Administrator.php" class="back-icon-btn">
    <svg class="back-icon" viewBox="0 0 24 24">
        <path d="M9 6l6 6-6 6" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

</div>
  <h1 class="sentencs">Security Awareness Level</h1>

  
  <div class="awareness">
    <div class="progress-container">
      <div class="progress-bar" id="progress"></div>
      <span class="progress-text" id="progress-text">Loading...</span>
    </div>

    <div class="circle-imge" id="circle-imge">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User">
    </div>
  </div>


  <div class="status" id="status">Loading...</div>

  <p class="loading" id="loading-text">Fetching awareness data...</p>
  
<div class="footer">
    <img class="logo-footer" src="imge\logofotter.svg"alt="logo"width="60px">

    <ul class="footer-item">
<li class="link-footer" >
    <img src="imge\call.svg"width="30px">
<a href="0501092200">0501092200</a>  
</li>
<li class="link-footer">
    <img src="imge\email icon.svg"width="30px">
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
  <script>
const progressBar  = document.getElementById("progress");
const progressText = document.getElementById("progress-text");
const circleImge   = document.getElementById("circle-imge");
const statusEl     = document.getElementById("status");
const loadingText  = document.getElementById("loading-text");

function updateUI(level) {

    if (level < 0) level = 0;
    if (level > 100) level = 100;

    progressBar.style.width = level + "%";
    progressText.textContent = level + "%";

    if (level < 30) {
        progressBar.style.background = "#ff4b2b";
        circleImge.style.border = "5px solid #ff4b2b";
        statusEl.textContent = "Low awareness level";
    } 
    else if (level < 70) {
        progressBar.style.background = "#ffbb00";
        circleImge.style.border = "5px solid #ffbb00";
        statusEl.textContent = "Moderate awareness level";
    } 
    else {
        progressBar.style.background = "#00ff84";
        circleImge.style.border = "5px solid #00ff84";
        statusEl.textContent = "High awareness level";
    }

    loadingText.style.display = "none";
}

function computeLevelFromData(data) {
    return data.baseLevel;  
}



document.addEventListener("DOMContentLoaded", () => {

    fetch("Security_Level.php?fetch_data=1")
        .then(res => res.json())
        .then(data => {
            console.log("⬅️ DATA RECEIVED:", data);

            const level = computeLevelFromData(data);

            console.log("✔️ Awareness Level Calculated:", level);

            updateUI(level);
        })
        .catch(err => console.error("❌ ERROR:", err));
});
</script>
 <script src="main.js"></script>

</body>
</html>
