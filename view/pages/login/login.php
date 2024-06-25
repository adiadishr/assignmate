<?php
require_once '../../../config.php';
if (isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are already logged in';
    header('Location: ../dashboard/dashboard.php');
    die();
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="login-container">
        <?php include '../../includes/message.php'; ?>
        <h1>Login</h1>
        <form method="post" action="../../../controllers/login-controller.php">
            <input required type="email" name="email" placeholder="Enter your email">
            <input required type="password" name="password" placeholder="Enter password">
            <input class="submit" type="submit" value="Login">
        </form>
        <h4>Don't have an account? <a href="../register/register.php">Register</a></h4>
    </div>
</body>

</html>