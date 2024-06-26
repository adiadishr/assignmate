<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM subjects WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="./dashboard.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php include '../../includes/message.php'; ?>
    <div class="container">
        <div class='top-bar'>
            <a class="brand" href="./dashboard.php">
                <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
                <h1>Assign<span>Mate</span></h1>
            </a>
            <nav>
                <a href="#" id="logout-btn">Logout</a>
            </nav>
        </div>
        <div class="greeting">
            <h1>Hi, <span><?= $_SESSION['full_name'] ?>!</span></h1>
            <p>Welcome to your dashboard, hope you have a productive day!</p>
        </div>
        <div class="controls">
            <a href="../view-assignments/view-assignments.php" class="control">Assignments
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="../view-subjects/view-subjects.php" class="control">Subjects
                <i class="fa-solid fa-chalkboard-user"></i>
            </a>
            <a href="../view-edit-profile/profile.php" class="control">Profile
                <i class="fa-regular fa-user"></i>
            </a>
            <!-- <a href="../../../controllers/page-not-found-controller.php" class="control">Statistics
                <i class="fa-solid fa-chart-simple"></i>
            </a> -->
        </div>
        <div id="logout-modal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <p>Are you sure you want to logout?</p>
                <a href="../../../controllers/logout-controller.php" class="btn">Yes</a>
                <button id="cancel-logout" class="btn">No</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('logout-btn');
            const modal = document.getElementById('logout-modal');
            const closeModalBtn = modal.querySelector('.close-btn');
            const cancelBtn = modal.querySelector('#cancel-logout');

            // Function to open modal
            logoutBtn.addEventListener('click', function(event) {
                event.preventDefault();
                modal.style.display = 'flex';
            });

            // Function to close modal
            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Function to close modal on cancel button click
            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Close modal if user clicks outside of modal content
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>