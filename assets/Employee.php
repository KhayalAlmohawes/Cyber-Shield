<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Employee page</title>
 <!-- css -->
 <link rel="stylesheet" href="style.css">
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
<H1 class="sentencs">Stay <span class="blue">Aware</span>, Stay <span class="green">Protected</span> .<H1>
<div class="admin-cards">
<div class="admin-card">
<a href="Security_level.php">
<img src="imge/Security Awareness Level.png" alt="">
Security Awareness Level 
</a></div>
<div class="admin-card">
<a href="Awareness Library.html " >
<img src="imge\Awareness Library.png" alt="">
Awareness Library </a> </div>
<div class="admin-card">
<a href="report.php">
<img src="imge/Report Suspicious Massage.png" alt="">
Report Suspicious Massage
</a>
</div>
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
