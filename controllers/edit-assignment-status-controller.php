<?php
require_once '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $assignment_id = $_POST['assignment_id'];
    $status = $_POST['status'];
    $sql = "UPDATE assignments SET status = '$status' WHERE id = $assignment_id AND user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = 'Assignment status updated successfully';
        header("Location: ../view/pages/view-assignment-detail/view-assignment-detail.php?id=$assignment_id");
        die;
    } else {
        $_SESSION['error'] = 'Failed to update assignment status';
        header("Location: ../view/pages/view-assignment-detail/view-assignment-detail.php?id=$assignment_id");
        die;
    }
}
