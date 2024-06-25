<?php
require '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_name = $_POST["name"];
    $subject_id = $_POST["id"];

    $sql = "UPDATE subjects SET name = '$subject_name' WHERE id = $subject_id AND user_id = '$_SESSION[user_id]'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = "Subject updated successfully.";
        header("Location: ../view/pages/view-subjects/view-subjects.php");
        die;
    } else {
        $_SESSION["error"] = "Database error. Please try again later.";
        header("Location: ../view/pages/edit-subject/edit-subject.php");
        die;
    }
}
