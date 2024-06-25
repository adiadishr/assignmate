<?php
require_once '../../../config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="../../../public/css/modules/login-register.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <div class='top-bar top-bar-login-register'>
        <a class="brand" href="../../../index.php">
            <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
            <h1>Assign<span>Mate</span></h1>
        </a>
        <nav>
            <a class="back-btn" href="../../../index.php">Go back</a>
        </nav>
    </div>
    <div class="register-container">
        <?php include '../../includes/message.php'; ?>
        <h1>Register</h1>
        <form method="post" action="../../../controllers/register-controller.php">
            <input type="text" name="full_name" placeholder="Enter your name">
            <input type="email" name="email" placeholder="Enter your email">
            <input type="number" name="phone_no" placeholder="Enter your phone number">
            <input type="password" name="password" placeholder="Enter password">
            <input class="submit" type="submit" value="Register">
        </form>
        <h4>Already have an account? <a href="../login/login.php">Login</a></h4>
</body>

</html>