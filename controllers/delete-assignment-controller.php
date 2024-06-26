<?php
include '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT user_id FROM assignments WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['user_id'] == $user_id) {
        $sql = "DELETE FROM assignments WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION["success"] = "Assignment deleted successfully.";
            header("Location: ../view/pages/view-assignments/view-assignments.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "You are not authorized to delete this assignment.";
        header("Location: ../view/pages/view-assignment-detail/view-assignment-detail.php?id=$id");
        exit();
    }
}
