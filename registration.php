<?php
session_start();
include('includes/header.php');
include('config/dbconn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Load Composer's autoloader
require 'vendor/autoload.php';

function sendmail_verify($name, $email, $otp)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dfedf06e0e3601';                     //SMTP username
    $mail->Password   = '24c119c297157e';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 2525;

    $mail->setFrom('sthabeejay2060@gmail.com', $name);
    $mail->addAddress($email);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification From AdminLTE 3';

    $email_template = "
    <h2>You Have Registered With AdminLTE 3</h2>
    <h5>Verify Your Email Address with the following 5-digit code:</h5>
    <p><strong>Code:</strong> $otp</p>
";

    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

$nameError = "";
$emailError = "";
$passwordError = "";
$phoneError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST['role']; 
    $randomNumber = rand(100000, 999999); // Generate a random 6-digit number
    $otp = md5(rand()) . $randomNumber;

    if (empty($name)) {
        $nameError = "Name is required";
    } else {
        $username = trim($name);
        $username = htmlspecialchars($name);
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $nameError = "Name should contain characters and whitespace";
        }
    }
    if (empty($phone)) {
        $phoneError = "Phone number is required";
    } else {
        if (!preg_match('/^(98|97)\d{8}$/', $phone)) {
            $phoneError = "Invalid phone number format. It should start with '98' or '97' and be 10 digits long.";
        }
    }

    // Validate email
    if (empty($email)) {
        $emailError = "Email is required";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        } elseif (substr_count($email, '.com') !== 1) {
            $emailError = "Email should contain '.com' exactly once";
        }
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required";
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@$#!%*?&]{8,}$/', $password)) {
            $passwordError = "Password should contain at least one uppercase letter, one lowercase letter, one digit, one symbol, and be at least 8 characters long";
        }
    }

    if (!($nameError) && !($emailError) && !($passwordError) && !($phoneError)) {
        $check_email_query = "SELECT email FROM user WHERE email='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_email_query_run) > 0) {
            $_SESSION['status'] = "Email Id already exist";
            header('Location:registration.php');
        } else {
            // Registration successful, generate a random 5-digit code
            $randomCode = rand(10000, 99999);

            // Insert user data into the database
            $user_query = "INSERT INTO user (name,phone,email,password,otp,role) values('$name','$phone','$email','$password','$randomCode','$role')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                // Send email with the 5-digit code
                sendmail_verify($name, $email, $randomCode);


                $_SESSION['status'] = "Registration Successfully";
                $_SESSION['status_code']="success";
                $_SESSION['email'] = $email;
                $_SESSION['otp'] = $randomCode;
                header("Location:otp.php");
                
            }
        }
    } else {
        $_SESSION['status'] = "Registration Unsuccessful !!";

    }
}
?>


<div class="section">
    <div class="container">
       <div class=" row justify-content-center">
        <div class="col-md-5 my-5">
            <div class="card my-5">

                <div class="card-header bg-light">
                    <h5>Registration Form</h5>
                </div>
                <div class="card-body">
                  <?php
                    include('message.php');
                  ?>
                    <form action="" method="POST">
                    <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                            <span style="color:red;"> <?php echo $nameError ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
                            <span style="color:red;"> <?php echo $phoneError ?></span>
                        </div>
                    
                        <div class="form-group">
                            <label for="">Email Id</label>
                            <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                            <span style="color:red;"> <?php echo $emailError ?> </span>
                         
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-group">
                                 <input type="password" name="password" id="password" class="form-control" placeholder="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
                            <div class="input-group-append">
                              <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                 <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            </div>
                            <span style="color:red;"> <?php echo $passwordError ?> </span>
                        </div>

                        <label for="role">Select Role:</label>
                            <select name="role" id="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <!-- Add other roles as needed -->
                            </select>


                        <hr>
                        <div class="form-group">
                            <button type="submit" name="register_btn" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <div class="form-group">
                                <label for="">Already Have Account ?</label>
                                <a href="login1.php">Login Now</a>
                            </div>

                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
<?php   include('includes/script.php'); ?>
<script>
    // JavaScript code for password toggle
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // Toggle eye icon
        togglePassword.innerHTML =
            type === 'password' ? '<i class="fa fa-eye" aria-hidden="true"></i>' : '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
    });
</script>


