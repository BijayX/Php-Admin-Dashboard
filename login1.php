<?php
session_start();
include('includes/header.php');
if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You are already Logged In";
    header('Location: index.php');
}

// Check if the 'user_email' cookie is set
if (isset($_COOKIE['user_email'])) {
    $preFilledEmail = $_COOKIE['user_email'];
} else {
    $preFilledEmail = '';
}
if (isset($_COOKIE['user_password'])) {
    $preFilledpassword = $_COOKIE['user_password'];
} else {
    $preFilledpassword = '';
}
?>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                <div class="card my-5">
                    <div class="card-header bg-light">
                        <h5>Login Form</h5>
                        
                    </div>
                    <div class="card-body">
                        <?php include('message.php'); ?>
                        <form action="logincode.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email Id</label>
                                <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?= $preFilledEmail ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?= $preFilledpassword ?>">
                                    <div class="input-group-append">
                                        <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="rememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button type="submit" name="login_btn" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div class="form-group">
                                <label for="">Not Register ?</label>
                                <a href="registration.php">Register Now</a>
                                <br>
                                <a href="forget-password.php">Forget Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

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
