<?php
require_once '../config.php';
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = validate_input($_POST["full_name"]);
    $email = validate_input($_POST["email"]);
    $phone_no = validate_input($_POST["phone_no"]);
    $password = validate_input($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($full_name) || empty($email) || empty($phone_no) || empty($password)) {
        $_SESSION['error'] = "Please fill in all the fields";
        header("Location: ../view/pages/register/register.php");
        die;
    }

    $email_check_query = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $email_check_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Email already registered";
        header("Location: ../view/pages/register/register.php");
        die;
    }

    $sql = "INSERT INTO users (full_name, email, phone_no, password) VALUES ('$full_name', '$email', '$phone_no', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "You have successfully registered";
        header("Location: ../view/pages/login/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header("Location: ../view/pages/register/register.php");
        die;
    }
}
