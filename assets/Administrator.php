<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: employee.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> admin Cyber Shield platform</title>
    <!-- css -->
 <link rel="stylesheet" href="style.css">
 <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
</div><!-- nav close -->
<H1 class="sentencs"><span class="green">Empower</span> Your Team, <span class="blue">Secure </span>Your Future</H1>

<div class="admin-cards">
<div class="admin-card">
<a href="admin_videos.php" target="_blank">
<img src="imge/Awareness Resources.jpg" alt="">
Awareness Resources 
</a>
</div>
<div class="admin-card">
<a href="Launch_page.php"target="_blank">
<img src="imge/lanuch campain.jpg" alt="">
Launch  a Campaign 
</a></div>
<div class="admin-card">
<a href="View_Reports.php"target="_blank">
<img src="imge\View Reports.jpg"alt="">
View Reports
</a> </div>
</div>
<div class="footer">
<img class="logo-footer" src="imge/logofotter.svg" alt="logo" width="70px">

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
 <script src="main.js"></script>
</body>
</html>