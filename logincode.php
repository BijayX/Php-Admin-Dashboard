<?php
session_start();
include('config/dbconn.php');

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['status'] = "Please fill in all fields";
        header('Location: login1.php');
        exit();
    }

    $log_query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
    $log_query_run = mysqli_query($con, $log_query);

    if ($log_query_run) {
        $user_data = mysqli_fetch_assoc($log_query_run);

        if ($user_data) {
            if ($user_data['status'] == 'verified') {
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'user_id' => $user_data['id'],
                    'user_name' => $user_data['name'],
                    'user_email' => $user_data['email'],
                    'user_phone' => $user_data['phone'],
                    'user_role' => $user_data['role'],
                ];

               // Set cookie for 6 seconds
                setcookie('user_email', $user_data['email'], time() + 60, '/');
                setcookie('user_password', $user_data['password'], time() + 60, '/');

                $_SESSION['status'] = "Logged in successfully";

                if ($user_data['role'] == 'admin' || $user_data['role'] == 'manager' || $user_data['role'] == 'HR') {
                    header('Location: index.php');
                    $_SESSION['status'] = "Admin Login Successful";
                    $_SESSION['status_code'] = "success";
                } else {
                    header('Location: user_dash.php');
                    $_SESSION['status'] = "User Login Successful";
                    $_SESSION['status_code'] = "success";
                }
            } else {
                $_SESSION['status'] = "Email not verified. Please check your email for the verification code.";
                header('Location: login1.php');
            }
        } else {
            $_SESSION['status'] = "Invalid Email or Password";
            $_SESSION['status_code'] = "error";
            header('Location: login1.php');
        }
    } else {
        $_SESSION['status'] = "Database error";
        header('Location: login1.php');
    }
} else {
    $_SESSION['status'] = "Access Denied";
    header('Location: login1.php');
}
?>
