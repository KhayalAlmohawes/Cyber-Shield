<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass  = $_POST['password'] ?? '';
    if ($email === '' || $pass === '') {
        $error = 'Please fill out all fields.';
    } else {
        $stmt = $conn->prepare('SELECT MemberId, Password, role FROM members WHERE EmailAddres = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        if ($row && password_verify($pass, $row['Password'])) {
            $_SESSION['user_id'] = $row['MemberId'];
            $_SESSION['role']    = strtolower($row['role']);

            if ($_SESSION['role'] === 'admin') {
                header('Location: Administrator.php'); exit;
            } else {
                header('Location: Employee.php'); exit;
            }
        } else {
              $error = '❌ Incorrect email or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login page</title>
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
</div>
<div class="login-container">
<h1 class="text">Login Form <hr></h1>
<form method="POST" action="" autocomplete="off">
 <div class="input">
<input type="text" style="display:none">
<input type="password" style="display:none">
   <input type="email" name="email" placeholder="Email Address" required autocomplete="off">
<input type="password" name="password" placeholder="Password" required autocomplete="new-password">
 </div>
 <button type="submit" class="login-btn">Login</button>
</form>
<?php if(!empty($error)): ?>
<p style="color:red; text-align:center; margin-top:10px;"><?= $error ?></p>
<?php endif; ?>
</div>
<div class="footer">
    <img class="logo-footer" src="imge/logofotter.svg" alt="logo" width="60">
    <ul class="footer-item">
        <li class="link-footer" >
    <img src="imge\call.svg"width="30px"> <a href="0501092200">0501092200</a>   </li>
<li class="link-footer">  <img src="imge\email icon.svg"width="30px"> <a href="mailto:cybershield.platform@gmail.com">cybershield.platform</a>  </li>
        <li class="link-footer"><a href="policy.html">privacy policy</a></li>
        <li class="link-footer"><a href="Terms&conditions.html">Terms & conditions</a></li>
    </ul>
</div>
</body>
</html>
