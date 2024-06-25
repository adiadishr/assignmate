<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subject</title>
    <link rel="stylesheet" href="./create-subject.scss">
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <div class='top-bar top-bar-login-register'>
        <a class="brand" href="./dashboard.php">
            <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
            <h1>Assign<span>Mate</span></h1>
        </a>
        <nav>
            <a href="../view-subjects/view-subjects.php">Go back</a>
        </nav>
    </div>
    <div class="create-subject-container">
        <h1>Create Subject</h1>
        <form method="post" action="../../../controllers/create-subject-controller.php">
            <input type="text" name="name" placeholder="Enter subject name" required>
            <input class="submit" type="submit" value="Create">
        </form>
    </div>
</body>

</html>