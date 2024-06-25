<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}

$sql = "SELECT * FROM assignments";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment List</title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="./view-assignments.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php require_once '../../includes/message.php'; ?>
    <div class="view-assignments-container">
        <div class='top-bar'>
            <a class="brand" href="../dashboard/dashboard.php">
                <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
                <h1>Assign<span>Mate</span></h1>
            </a>
            <nav>
                <a href="../create-assignment/create-assignment.php">
                    <pre><i class="fa-solid fa-plus"></i>  Create Assignment</pre>
                </a>
                <a href="../dashboard/dashboard.php">Go back</a>
            </nav>
        </div>
        <div class="overview">
            <div></div>
            <h1>Assignment <span>Overview</span></h1>
            <div class="sorting">Sort by: <i class="fa-solid fa-sort-down"></i></div>
        </div>
        <div class='view-assignments-main'>
            <div class="pending-container">
                <h1>Pending Assignments:</h1>
                <h1>14</h1>
            </div>
            <div class="assignment-list">
                <?php
                $sql = "SELECT assignments.*, subjects.name FROM assignments INNER JOIN subjects ON assignments.subject_id = subjects.id ORDER BY priority";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="assignment-card">
                        <?php
                        print_r($row);
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>