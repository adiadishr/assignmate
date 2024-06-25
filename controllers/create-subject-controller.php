<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_name = mysqli_real_escape_string($conn, $_POST["name"]);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO subjects (name, user_id) VALUES ('$subject_name', '$user_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = "Subject created successfully.";
        header("Location: ../view/pages/view-subjects/view-subjects.php");
        die;
    } else {
        $_SESSION["error"] = "Database error. Please try again later.";
        header("Location: ../view/pages/create-subject/create-subject.php");
        die;
    }
}
