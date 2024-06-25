<?php
require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'You are not logged in';
    header("Location: ../../../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['full_name'] ?>'s Profile</title>
    <link rel="stylesheet" href="../../../public/css/globals.scss">
    <link rel="stylesheet" href="./profile.scss">
    <link rel="stylesheet" href="../dashboard/dashboard.scss">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>

<body>
    <?php include '../../includes/message.php'; ?>
    <div class="profile-container">
        <div class='top-bar'>
            <a class="brand" href="./dashboard.php">
                <img src="../../../public/assets/logo.png" alt="Assignmate Logo">
                <h1>Assign<span>Mate</span></h1>
            </a>
            <nav>
                <a href="../dashboard/dashboard.php">Go back</a>
            </nav>
        </div>
        <div class="greeting">
            <h1>Your <span>Profile</span></h1>
        </div>
        <form method="post" action="../../../controllers/update-profile-controller.php">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input class="disabled" type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required disabled>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required disabled>
            </div>
            <div class="form-group">
                <label for="phone_no">Phone Number</label>
                <input class="disabled" type="text" id="phone_no" name="phone_no" value="<?= htmlspecialchars($user['phone_no']) ?>" required disabled>
            </div>
            <div class="button-group">
                <button type="button" id="edit-btn">Click to edit</button>
                <button type="submit" id="save-btn" disabled>Update details</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('edit-btn').addEventListener('click', function() {
            document.querySelectorAll('input.disabled').forEach(input => input.disabled = false);
            document.getElementById('edit-btn').innerHTML = 'You are now able to edit details';
            document.getElementById('edit-btn').disabled = true;
            document.getElementById('save-btn').disabled = false;
        });
    </script>
</body>

</html>