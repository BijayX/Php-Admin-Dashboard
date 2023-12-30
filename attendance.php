<?php
session_start();

// Set the timezone to 'Asia/Kathmandu'
date_default_timezone_set('Asia/Kathmandu');

// Check if the user is not logged in, redirect to login1.php
if (!isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You need to log in first";
    header('Location: login1.php');
    exit();
}

$nameError = "";
$phoneError = "";

$time_outError="";

include('includes/header.php');
include('includes/topbar copy.php');
include('includes/sidebar copy.php');
include('config/dbconn.php');

if (isset($_POST['submit_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];
    
    if (empty($name)) {
        $nameError = "Name is required";
    } else {
        $name = trim($name);
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
    if (empty($time_out)) {
        $time_outError = "Time In is required";
    } else {
        $currentDatetime = date('Y-m-d\TH:i');
       if ($time_out < $currentDatetime) {
             $time_outError = "Ends time should be before the current time.";
    }
}

    if (!$nameError && !$phoneError && !$time_outError) {
        // Update the Time In field with the current date and time
        $time_in = date('Y-m-d\TH:i');

        $user_query = "INSERT INTO attendance (name, phone, time_in, time_out) values('$name','$phone','$time_in','$time_out')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {
            $_SESSION['status'] = "Successfully recorded attendance";
            $_SESSION['status_code']="success";
            header("Location:attendance.php");
            

         
        } else {   
            $_SESSION['status'] = "Failed to record attendance";
            $_SESSION['status_code']="error";
            header("Location:attendance.php");
           // Ensure no further code is executed after a header redirect
        }
    } else {
        $_SESSION['status'] = "Failed. Please check the form for errors.";
    }
}

// Rest of your HTML code
?>

 <div class="content-wrapper">
 
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="indexcopy.php">Home</a></li>
              <li class="breadcrumb-item active">Attendance</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <section class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                  if(isset($_SESSION['status']))
                  {
                    echo "<h4>".$_SESSION['status']."</h4>";
                    unset($_SESSION['status']);
                  }
                ?>
    <!-- /.content-header -->
          <div class="card">
              <div class="card-header">
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php
                    include('message.php');
                  ?>
              <form action="" method="POST">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" ">
                            <span style="color:red;"> <?php echo $nameError ?> </span>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-3">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone" >
                            <span style="color:red;"> <?php echo $phoneError ?> </span>
                         </div>
                        </div>
                    
                        <div class="form-group">
                        <div class="col-md-3">
                            <label for="">Starts</label>
                            <input type="datetime-local" name="time_in" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
                         </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-3">
                            <label for="">Ends</label>
                            <input type="datetime-local" name="time_out" class="form-control" ">
                            <span style="color:red;"> <?php echo $time_outError ?> </span>
                        </div>
                          
                        </div>
                        <hr>
                        <div class="form-group">
                        <div class="col-md-2">
                            <button type="submit" name="submit_btn" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        </div>
                    </form>
                 
                
        
         </div>
      </div>
     </div>
   </div>
  </div>
</section>
</div>
<?php include('includes/footer.php'); ?>
