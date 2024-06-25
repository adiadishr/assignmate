<?php
require '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $subject_id = $_GET["id"];

    //query to check if the subject has assignments that belong to it
    $sql = "SELECT COUNT(*) FROM assignments WHERE subject_id = $subject_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['COUNT(*)'] > 0) {
        $_SESSION['error'] = "This subject cannot be deleted because it has assignments.";
        header("Location: ../view/pages/view-subjects/view-subjects.php");
        exit();
    }

    $sql = "DELETE FROM subjects WHERE id = $subject_id AND user_id = '$_SESSION[user_id]'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = "Subject deleted successfully.";
        header("Location: ../view/pages/view-subjects/view-subjects.php");
        die;
    } else {
        $_SESSION["error"] = "Database error. Please try again later.";
        header("Location: ../view/pages/delete-subject/delete-subject.php");
        die;
    }
}
