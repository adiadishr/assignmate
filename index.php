<?php
require_once 'config.php';
if (isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are already logged in.';
    header("Location: view/pages/dashboard/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignmate</title>
    <link rel="stylesheet" href="./public/css/index.scss">
    <link rel="stylesheet" href="./public/css/globals.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <div class="landing-container">
        <?php include './view/includes/message.php'; ?>
        <img src="./public/assets/logo.png" alt="Assignmate Logo">
        <h1>Welcome to Assign<span>Mate</span></h1>
        <div class="btn-holder">
            <a href="view/pages/login/login.php" class="btn">Login</a>
            <a href="view/pages/register/register.php" class="btn">Register</a>
        </div>
    </div>
</body>

</html>