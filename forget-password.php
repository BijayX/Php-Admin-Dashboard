<?php
session_start();
include('includes/header.php');
include('config/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $check_email_query = "SELECT id, name FROM user WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $user_data = mysqli_fetch_assoc($check_email_query_run);
        $user_id = $user_data['id'];

        // Generate a unique token
        $token = md5(uniqid($user_id, true));

        // Store the token in the database
        $update_token_query = "UPDATE user SET reset_token='$token' WHERE id='$user_id'";
        $update_token_query_run = mysqli_query($con, $update_token_query);

        if ($update_token_query_run) {
            // Send a password reset email with a link containing the token
            $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
            // Send email logic here (you can use the `sendmail_verify` function)

            $_SESSION['status'] = "Password reset link sent to your email. Please check your inbox.";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "Email not found";
    }
}
?>

<!-- Your HTML form for the email input -->
<form action="" method="POST">
    <label for="email">Enter your email:</label>
    <input type="text" name="email" required>
    <button type="submit" name="submit">Submit</button>
</form>
