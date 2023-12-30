<?php
session_start();
include('includes/header.php');
include('config/dbconn.php');
  $otpError="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = $_POST["otp"];

    // Assuming you have the user's email and OTP stored in the session after the registration
    // Replace 'user_email' and 'otp_code' with the actual session variables you used during registration
    $email = $_SESSION['email'];
    $otp = $_SESSION['otp'];

    if ($entered_otp == $otp) {
        // Valid OTP, redirect to login.php or perform additional actions
        // For example, you might want to update the user status to 'verified'
        // if(empty($otp)){
        //       $otpError="OTP code is Required";
        // }
        $update_status_query = "UPDATE user SET status = 'verified' WHERE email = '$email'";
        mysqli_query($con, $update_status_query);
        // Redirect to login.php or any other page as needed
        header("Location: login1.php");
        exit();
    } else {
        // Invalid OTP, display an error message
        $msg = "Invalid OTP. Please try again.";
    }
}

    echo '<script>alert("OTP has been sent to your email. Please Check Your Email !!");</script>';

?>

<div class="section">
    <div class="container">
       <div class=" row justify-content-center">
        <div class="col-md-5 my-5">
            <div class="card my-5">
                <div class="card-header bg-light">
                    <h5>Email Verification</h5>
                </div>
                <div class="card-body">
                <?php
                    if (isset($msg)) {
                        echo '<div class="alert alert-danger">' . $msg . '</div>';
                    }
                ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Enter OTP</label>
                            <input type="text" name="otp" class="form-control" placeholder="5 Digit code">
                            <span style="color:red;"> <?php echo $otpError ?> </span>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" name="login_btn" class="btn btn-primary btn-block">Verify OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
