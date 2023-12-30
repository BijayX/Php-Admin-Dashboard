<?php
session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You need to log in first";
    $_SESSION['status_code']="error";
    header('Location: login1.php');
    exit();
}
include('config/dbconn.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');

$username4 = '';
if (isset($_SESSION['auth_user']['user_id'])) {
    $username4 = $_SESSION['auth_user']['user_id'];
} else {
    echo '<a href="#" class="d-block">79</a>';
}

$nameError = "";
$emailError = "";
$phoneError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];



  // Validate ID
  if (empty($id) || !is_numeric($id)) {
      $_SESSION['status'] = "Invalid ID";
      header("Location: profile.php");
  }

  // Validate name
  if (empty($name)) {
      $nameError = "Name is required";
  } else {
      $name = trim($name);
      $name = htmlspecialchars($name);
      if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
          $nameError = "Name should contain characters and whitespace";
      }
  }

  // Validate phone
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

  // If no validation errors, proceed with the update
  if (!($nameError) && !($emailError) && !($phoneError)) {
      // Handle image upload
      if (!empty($_FILES['image']['name'])) {
        // Handle image upload only when a new image is selected

        $image = $_FILES['image']['name'];
        $allowed_extension = array('png', 'jpg', 'jpeg');
        $file_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $file_extension;

        if (!in_array($file_extension, $allowed_extension)) {
            $_SESSION['status'] = "You are allowed with only jpg, png, jpeg Image";
        } else {
            $target_directory = 'upload/profile/';
            $target_path = $target_directory . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                // If the image is successfully moved to the target directory
                // Update the database with the new image filename
                $query = "UPDATE user SET name='$name', phone='$phone', email='$email', image='$filename' WHERE id='$id'";
            } else {
                $_SESSION['status'] = "Image upload failed";
                header("Location: profile.php");
                exit(); // Stop further execution
            }
        }
    } else {
        // No new image selected, update the database without changing the image
        $query = "UPDATE user SET name='$name', phone='$phone', email='$email' WHERE id='$id'";
    }

    // Execute the database update query
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Update Successfully";
        $_SESSION['status_code']="success";
    } else {
        $_SESSION['status'] = "Update Failed.!!";
        header("Location: profile.php");
        exit(); // Stop further execution
    }
} else {
    $_SESSION['status'] = "Validation failed. Please check the form for errors.";
    $_SESSION['status_code']="error";
}
}

// ?>

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Admin Profile</h3>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                $query = "SELECT * FROM user WHERE id='$username4'";
                $result = mysqli_query($con, $query);

                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($data['name']); ?>" >
                            <span style="color:red;"> <?php echo $nameError ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                            <span style="color:red;"> <?php echo $emailError ?> </span>

                        </div>
                        <div class="form-group">
                            <label for="">Phone No</label>
                            <input type="tel" name="phone" class="form-control" value="<?php echo htmlspecialchars($data['phone']); ?>" >
                            <span style="color:red;"> <?php echo $phoneError ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="">Upload Image</label>
                            <div class="col-md-8">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($username4); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="ad_save" class="btn btn-primary">Save</button>
                    </div>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php')  ?>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <strong>Admin Profile</strong>
                            <a href="" data-toggle="modal" data-target="#categoryModal" class="btn btn-primary float-right">Update</a>
                        </h5>
                    </div>
                    <form action="">
                    <div class="card-body">
                    <div class="text-center">
                    
                    <?php
                        $query = " SELECT * FROM user   WHERE id='$username4'";
                        $result = mysqli_query($con, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                           <img  class="profile-user-img img-fluid img-circle" src="./upload/profile/<?php echo $data['image']; ?>" width="60" height="" alt="Profile Image">

                           <h3 class="profile-username text-center"><?php echo $data['name']; ?></h3>
                    </div>
                <div class="col-md-11">
                <!-- <div class="card card-primary"> -->
              <div class="card-header">
                <h3 class="card-title"><strong>About Me</strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the Kathamndu University 
                </p>

                <hr>


                <strong><i class="fas fa-envelope mr-1"></i>Email</strong>
                <p class="text-muted"><?php echo $data['email']; ?></p>
    
                <hr>

                <strong><i class="fas fa-phone mr-1"></i>Phone</strong>
                <p class="text-muted"  pattern="^(97|98)\d{8}$"><?php echo $data['phone']; ?></p>


                </div>
                 </div>

                        <?php
                        }
                        ?>
                  </div>


                    </form>
                               </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 


