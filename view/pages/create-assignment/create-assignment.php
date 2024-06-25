<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit();
}
$result = mysqli_query($conn, "SELECT id, name FROM subjects WHERE user_id = '$_SESSION[user_id]'");
$count_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM subjects WHERE user_id = '$_SESSION[user_id]'");
$count_row = mysqli_fetch_assoc($count_result);
$count = $count_row['count'];
if ($count <= 0) {
    $_SESSION["error"] = "You need to create a subject first.";
    header("Location: ../view-assignments/view-assignments.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assignment</title>
    <link rel="stylesheet" href="./create-assignment.scss">
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php require_once '../../includes/message.php'; ?>
    <div class='top-bar top-bar-login-register'>
        <a class="brand" href="./dashboard.php">
            <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
            <h1>Assign<span>Mate</span></h1>
        </a>
        <nav>
            <a href="../view-assignments/view-assignments.php">Go back</a>
        </nav>
    </div>
    <div class="create-assignment-container">
        <h1>Create Assignment</h1>
        <form method="post" action="../../../controllers/create-assignment-controller.php">
            <form action="create_assignment.php" method="post">
                <label for="subject">Select Subject:</label>
                <select id="subject" name="subject_id" required>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="title">Assignment Title:</label>
                <input type="text" id="title" name="title" required>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
                <br>
                <label for="assigned_date">Assigned Date:</label>
                <input type="date" id="assigned_date" name="assigned_date" required>
                <br>
                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" required>
                <br>
                <input type="submit" value="Create Assignment" />
            </form>
    </div>

</body>

</html>