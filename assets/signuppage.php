<?php
include 'db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['user_email'] ?? '';
    $password = $_POST['user_pass'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $department = $_POST['department'] ?? '';

    if ($fullname === '' || $email === '' || $password === '' || $phone === '' || $department === '') {
        echo "<script>alert('❌ Please fill in all fields');</script>";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = "SELECT * FROM members WHERE EmailAddres='$email'";
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            echo "<script>alert('⚠️ Email is already registered'); window.location='signuppage.php';</script>";
        } else {
            $sql = "INSERT INTO members (FullName, EmailAddres, Password, PhoneNumber, DepartmentId)
                    VALUES ('$fullname', '$email', '$hashed_password', '$phone', '$department')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
        alert('✅ Account created successfully!');
        window.location.href = 'login.php';
    </script>";
                exit;
            } else {
                echo '<script>alert("❌ Input Error: ' . $conn->error . '");</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Shield platform</title>
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
        <img class="logo" src="imge\Group 4.svg" alt="logo" width="20px">
        <ul class="nav-item">
            <li class="link">
                <a href="index.php">Home</a>
            </li>
            <li class="link">
                <a href="signuppage.php">join us</a>
            </li>
            
    </div>
    <!-- nav close -->
    <div class="login-container">
        <h1 class="text">Signup Form
            <hr>
        </h1>
        <div class="div-button">
            <a href="login.php" target="_blank" class="Login-Signup-btn">Login</a>
            <a href="signuppage.php" target="_blank" class="Login-Signup-btn">Sign up</a>
        </div>

        <div class="input">
            <form method="POST" action="" autocomplete="off">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="email" name="user_email" placeholder="Email Address" required autocomplete="off">
                <input type="password" name="user_pass" placeholder="Password" required autocomplete="new-password">
                <input type="password" name="confirm" placeholder="Confirm Password" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <select id="department" name="department" class="select-box" required>
                    <option value="" disabled selected>Select your department</option>
                    <option value="1">New Hires and Remote Worker</option>
                    <option value="2">IT and Help Desk</option>
                    <option value="3">Finance and Accounting</option>
                    <option value="4">Sales and Marketing</option>
                </select>
                <button type="submit" class="login-btn">Signup</button>
            </form>
        </div>
    </div>
    <!-- login close -->
    <div class="footer">
        <img class="logo-footer" src="imge\Group 4.svg" alt="logo" width="100">

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
    <!-- footerclose -->
    <!-- jc -->
    <script src="main.js"></script>
</body>

</html>