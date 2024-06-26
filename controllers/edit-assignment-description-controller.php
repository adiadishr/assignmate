<?php
include '../config.php';
function sanitize($input)
{
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    return $input;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['assignment_id'];
    $description = sanitize($_POST['description']);
    $user_id = sanitize($_SESSION['user_id']);
    $sql = "UPDATE assignments SET description = '$description' WHERE id = '$id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION["success"] = "Description updated successfully.";
        header("Location: ../view/pages/view-assignment-detail/view-assignment-detail.php?id=$id");
        exit();
    }
}
