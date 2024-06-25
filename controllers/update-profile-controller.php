<?php
require '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $phone_no = $_POST["phone_no"];

    $sql = "UPDATE users SET full_name = '$full_name', phone_no = '$phone_no' WHERE id = '$_SESSION[user_id]'";
    $result = mysqli_query($conn, $sql);



    if ($result) {
        $_SESSION['success'] = "Profile updated successfully.";
        header("Location: ../view/pages/view-edit-profile/profile.php");
        $_SESSION['full_name'] = $full_name;
        $_SESSION['email'] = $email;
        $_SESSION['phone_no'] = $phone_no;
        die;
    } else {
        $_SESSION["error"] = "Database error. Please try again later.";
        header("Location: ../view/pages/update-profile/update-profile.php");
        die;
    }
}
