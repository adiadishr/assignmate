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

    $email = validate_input($_POST["email"]);
    $password = validate_input($_POST["password"]);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in all the fields";
        header("Location: ../view/pages/login/login.php");
        die;
    }

    $sql = "SELECT id, full_name, password FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1)  {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];
            $full_name = $row['full_name'];
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['email'] = $email;
                $_SESSION['$phone_no'] = $phone_no;
                $_SESSION['success'] = "Login successful.";
                header("Location: ../view/pages/dashboard/dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Incorrect password. Please try again.";
                header("Location: ../view/pages/login/login.php");
                die;
            }
        } else {
            $_SESSION['error'] = "User not found. Please register or try again.";
            header("Location: ../view/pages/login/login.php");
            die;
        }
    } else {
        $_SESSION['error'] = "Database error. Please try again later.";
        header("Location: ../view/pages/login/login.php");
        die;
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../view/pages/login/login.php");
    die;
}

