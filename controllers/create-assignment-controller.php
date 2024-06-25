<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_id = $_POST['subject_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $assigned_date = $_POST['assigned_date'];
    $due_date = $_POST['due_date'];
    $user_id = $_SESSION['user_id'];

    if (empty($subject_id) || empty($title) || empty($description) || empty($assigned_date) || empty($due_date)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../view/pages/create-assignment/create-assignment.php");
        exit();
    }

    $current_year = date("Y");
    $assigned_year = date("Y", strtotime($assigned_date));
    $due_year = date("Y", strtotime($due_date));

    if ($assigned_year > $current_year || $due_year > $current_year || $assigned_year < $current_year || $due_year < $current_year) {
        $_SESSION['error'] = "Invalid date.";
        header("Location: ../view/pages/create-assignment/create-assignment.php");
        exit();
    }

    $assigned_timestamp = strtotime($assigned_date);
    $due_timestamp = strtotime($due_date);
    $diff_seconds = $due_timestamp - $assigned_timestamp;
    $difference = floor($diff_seconds / (60 * 60 * 24));

    if ($difference < 0) {
        $_SESSION['error'] = "Due date cannot be earlier than assigned date.";
        header("Location: ../view/pages/create-assignment/create-assignment.php");
        exit();
    }

    if ($difference < 7) {
        $priority = "high";
    } else if ($difference >= 7 && $difference <= 14) {
        $priority = "medium";
    } else {
        $priority = "low";
    }

    $sql = "INSERT INTO assignments (subject_id, user_id, priority, assigned_date, due_date, title, description) VALUES ('$subject_id', '$user_id', '$priority', '$assigned_date', '$due_date', '$title', '$description')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION["success"] = "Assignment created successfully.";
        header("Location: ../view/pages/view-assignments/view-assignments.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header("Location: ../view/pages/create-assignment/create-assignment.php");
        exit();
    }
}
