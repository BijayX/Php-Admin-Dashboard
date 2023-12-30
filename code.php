<?php
  session_start();
  include('config/dbconn.php');
  if(isset($_POST['logout_btn'])){
    session_destroy();
    unset( $_SESSION['auth'] );
    unset($_SESSION['auth_user']);

    $_SESSION['status']="Logged out Successfully";
    header('Location:login1.php');
    exit(0);
  }


if(isset($_POST['product_update']))
{
  $product_id= $_POST['product_id'];
  $category_id=$_POST['category_id'];
  $name=$_POST['name'];
  $small_description=$_POST['small_description'];
  $price=$_POST['price'];
  $offerprice=$_POST['offerprice'];
  $tax=$_POST['tax'];
  $quantity=$_POST['quantity'];
  $status=$_POST['status']== true ? '1':'0';

  $image=$_FILES['image']['name'];
  $old_image=$_POST['old_image'];

  if($image !=''){
      $update_filename=$_FILES['image']['name'];

      $allowed_extension = array('png', 'jpg', 'jpeg');
      $file_extension=pathinfo($image,PATHINFO_EXTENSION);

      $filename=time().'.'.$file_extension;
      if(!in_array($file_extension,$allowed_extension)){
        $_SESSION['status']="You are allowed with only jpg,png,jepg Image";
        header("Location:product-add.php");
        exit(0);
      }
      $update_filename = $filename;
  }
  else{
    $update_filename= $old_image;
  }
  $query = "UPDATE product SET category_id='$category_id', name='$name', small_description='$small_description', price='$price', offerprice='$offerprice', tax='$tax', quantity='$quantity', image='$update_filename', status='$status' WHERE id='$product_id'";
          $query_run=mysqli_query($con,$query);
          if($query_run){
             if($image !=''){
              move_uploaded_file($_FILES['image']['tmp_name'],'uploads/product/'.$filename);
              if(file_exists('uploads/product/'.$old_image))
              {
                unlink("uploads/product/'.$old_image");
              }
             }
             $_SESSION['status']="Product Update Successfully";
             header('Location:product-edit.php?prod_id='.$product_id);
             exit(0);
          }
          else
          {
            $_SESSION['status']="Product Update failed";
            header('Location:product-edit.php?prod_id='.$product_id);
            exit(0);
          }
  
}


if(isset($_POST['product_save'])){
  $category_id=$_POST['category_id'];
  $name=$_POST['name'];
  $small_description=$_POST['small_description'];
  $price=$_POST['price'];
  $offerprice=$_POST['offerprice'];
  $tax=$_POST['tax'];
  $quantity=$_POST['quantity'];
  $status=$_POST['status']== true ? '1':'0';
  $image=$_FILES['image']['name'];

  $allowed_extension = array('png', 'jpg', 'jpeg');
  $file_extension=pathinfo($image,PATHINFO_EXTENSION);

  $filename=time().'.'.$file_extension;
  if(!in_array($file_extension,$allowed_extension)){
    $_SESSION['status']="You are allowed with only jpg,png,jepg Image";
    header("Location:product-add.php");
    exit(0);
  }
  else
  {
    $query="INSERT INTO product(category_id,name,small_description,price,offerprice,tax,quantity,image,status)
     VALUES('$category_id','$name','$small_description','$price','$offerprice','$tax','$quantity','$filename','$status')";
  $query_run=mysqli_query($con,$query);
  if($query_run){
    move_uploaded_file($_FILES['image']['tmp_name'],'uploads/product/'.$filename);
    $_SESSION['status']="Product Added Successfully";
    header("Location:product-add.php");
    exit(0);
  }
  else{
    $_SESSION['status']="Something is Wrong";
    header("Location:product-add.php");
    exit(0);
  }

}
}



  if(isset($_POST["category_save"])){
      $name=$_POST["name"];
      $description=$_POST["description"];
      $trending=$_POST["trending"]== true ? '1':'0';
      $status=$_POST["status"] == true ? '1':'0';

      $category_query="INSERT INTO category(name,description,trending,status) VALUES('$name','$description','$trending','$status')";
      $cate_gory_run=mysqli_query($con,$category_query);
      if($cate_gory_run){
        $_SESSION['status']="Category Insertion Successfully";
        header("Location:category.php");

      }
      else{
        $_SESSION['status']="Category Insertion Failed.!!";
        header("Location:category.php");

      }
  }

  if(isset($_POST['addUser']))
  {
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];

    if($password== $confirmpassword){
          $user_query="INSERT INTO users (name,phone,email,password) values('$name','$phone','$email','$password')";
          $user_query_run=mysqli_query($con, $user_query);
          if($user_query_run){
              $_SESSION['status']="User added Successfully";
                header("Location:registered.php");
          }
          else{
              $_SESSION['status']="User Registration Failed !!";
              header("Location:registered.php");
          }
      
    }
    else{
      $_SESSION['status']="Password and confirm Password Doesnot Match";
      header("Location:registered.php");
    }

         
  }
  if(isset($_POST['UpdateUser'])){
    $user_id=$_POST['user_id'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query = "UPDATE users SET name='$name', phone='$phone', email='$email', password='$password' WHERE id='$user_id'";
    $query_run=mysqli_query($con,$query);
    if($query_run){
      $_SESSION['status']="User Update Successfully";
      $_SESSION['status_code']="success";
        header("Location:registered.php");
    }
    else{
        $_SESSION['status']="User Updating Failed !!";
        header("Location:registered.php");
    }

  }
  if(isset($_POST['category_update'])){
    $cate_id=$_POST['cate_id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $trending=$_POST['trending']==true ? '1':'0';
    $status=$_POST['status']==true ? '1':'0';

    $query = "UPDATE category SET name='$name', description='$description', trending='$trending', status='$status' WHERE id='$cate_id'";
    $query_run=mysqli_query($con,$query);
    if($query_run){
      $_SESSION['status']="Category Update Successfully";
      $_SESSION['status_code']="success";
        header("Location:category.php");
    }
    else{
        $_SESSION['status']="Category Updating Failed !!";
        header("Location:category.php");
    }

  }

  if(isset($_POST['cate_delete_btn'])){
    $cate_id=$_POST['cate_delete_id'];
    $query = "DELETE FROM category WHERE id='$cate_id'";
    $query_run=mysqli_query($con,$query);
    if($query_run){
      $_SESSION['status']="Category Deleted Successfully";
      $_SESSION['status_code']="success";

        header("Location:category.php");
    }
    else{
        $_SESSION['status']="Category Deleting Failed !!";
        header("Location:category.php");
    }
  }


  if(isset($_POST['register_btn']))
  {
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $user_query="INSERT INTO user (name,phone,email,password) values('$name','$phone','$email','$password')";
          $user_query_run=mysqli_query($con, $user_query);
          if($user_query_run){
              $_SESSION['status']="Registration Successfully";
              $_SESSION['status_code']="success";
                header("Location:login1.php");

          }
          else
          {
            $_SESSION['status']="Registration Failed";
            $_SESSION['status_code']="error";
            header("Location:Registration.php");
          }

         
  }


  if(isset($_POST['submit_btn']))
  {
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $time_in=$_POST['time_in'];
    $time_out=$_POST['time_out'];

    $user_query="INSERT INTO attendance (name,phone,time_in,time_out) values('$name','$phone','$time_in','$time_out')";
          $user_query_run=mysqli_query($con, $user_query);
          if($user_query_run){
              $_SESSION['status']="Successfull";
              $_SESSION['status_code']="success";
                header("Location:user_dash.php");

          }
          else
          {
            $_SESSION['status']="Failed";
            header("Location:attendance.php");
          }

         
  }
//   if(isset($_POST["ad_save"])){

//     $name=$_POST["name"];
//     $email=$_POST["email"];
//     $phone=$_POST["phone"];
//     $image=$_POST["image"] ;


//     $ad_query="INSERT INTO adprofile(name,email,phone,image) VALUES('$name','$email','$phone','$image')";
//     $ad_gory_run=mysqli_query($con,$ad_query);
//     if($ad_gory_run){
//       $_SESSION['status']="Updated successfully";
//       header("Location:profile.php");

//     }
//     else{
//       $_SESSION['status']="Update Failed.!!";
//       header("Location:profile.php");

//     }
// }
// if(isset($_POST['ad_save'])){
//   $id = $_POST['id'];
//   $name=$_POST['name'];
//   $phone=$_POST['phone'];
//   $email=$_POST['email'];


//   $query = "UPDATE user SET name='$name', phone='$phone', email='$email' WHERE id='$id'";
//   $query_run=mysqli_query($con,$query);
//   if($query_run){
//     $_SESSION['status']="Update Successfully";
//       header("Location:profile.php");
//   }
//   else{
//       $_SESSION['status']="Category Updating Failed !!";
//       header("Location:profile.php");
     
// }
//   }
// ...

// if (isset($_POST['ad_save'])) {
//   $id = $_POST['id'];
//   $name = $_POST['name'];
//   $phone = $_POST['phone'];
//   $email = $_POST['email'];

//   // Handle image upload
//   $image = $_FILES['image']['name'];
//   $allowed_extension = array('png', 'jpg', 'jpeg');
//   $file_extension = pathinfo($image, PATHINFO_EXTENSION);
//   $filename = time() . '.' . $file_extension;

//   if (!in_array($file_extension, $allowed_extension)) {
//       $_SESSION['status'] = "You are allowed with only jpg, png, jpeg Image";
//       header("Location:profile.php");
//       exit(0);
//   } else {
//       $target_directory = 'upload/profile/';
//       $target_path = $target_directory . $filename;

//       if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
//           $query = "UPDATE user SET name='$name', phone='$phone', email='$email', image='$filename' WHERE id='$id'";
//           $query_run = mysqli_query($con, $query);

//           if ($query_run) {
//               $_SESSION['status'] = "Update Successfully";
//               header("Location:profile.php");
//               exit(0);
//           } else {
//               $_SESSION['status'] = "Update Failed.!!";
//               header("Location:profile.php");
//               exit(0);
//           }
//       } else {
//           $_SESSION['status'] = "Image upload failed";
//           header("Location:profile.php");
//           exit(0);
//       }
//   }
// }

// ...

// if (isset($_POST['ad_save'])) {
//   $id = $_POST['id'];
//   $name = $_POST['name'];
//   $phone = $_POST['phone'];
//   $email = $_POST['email'];

//   // Validation
//   $nameError = $phoneError = $emailError = "";

//   // Validate ID
//   if (empty($id) || !is_numeric($id)) {
//       $_SESSION['status'] = "Invalid ID";
//       header("Location: profile.php");
//       exit(0);
//   }

//   // Validate name
//   if (empty($name)) {
//       $nameError = "Name is required";
//   } else {
//       $name = trim($name);
//       $name = htmlspecialchars($name);
//       if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
//           $nameError = "Name should contain characters and whitespace";
//       }
//   }

//   // Validate phone
//   if (empty($phone)) {
//       $phoneError = "Phone number is required";
//   } else {
//       if (!preg_match('/^(98|97)\d{8}$/', $phone)) {
//           $phoneError = "Invalid phone number format. It should start with '98' or '97' and be 10 digits long.";
//       }
//   }

//   // Validate email
//   if (empty($email)) {
//       $emailError = "Email is required";
//   } else {
//       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//           $emailError = "Invalid email format";
//       } elseif (substr_count($email, '.com') !== 1) {
//           $emailError = "Email should contain '.com' exactly once";
//       }
//   }

//   // If no validation errors, proceed with the update
//   if (!($nameError) && !($emailError) && !($phoneError)) {
//       // Handle image upload
//       $image = $_FILES['image']['name'];
//       $allowed_extension = array('png', 'jpg', 'jpeg');
//       $file_extension = pathinfo($image, PATHINFO_EXTENSION);
//       $filename = time() . '.' . $file_extension;

//       if (!in_array($file_extension, $allowed_extension)) {
//           $_SESSION['status'] = "You are allowed with only jpg, png, jpeg Image";
//           header("Location: profile.php");
//           exit(0);
//       } else {
//           $target_directory = 'upload/profile/';
//           $target_path = $target_directory . $filename;

//           if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
//               // Update database
//               $query = "UPDATE user SET name='$name', phone='$phone', email='$email', image='$filename' WHERE id='$id'";
//               $query_run = mysqli_query($con, $query);

//               if ($query_run) {
//                   $_SESSION['status'] = "Update Successfully";
//                   header("Location: profile.php");
//                   exit(0);
//               } else {
//                   $_SESSION['status'] = "Update Failed.!!";
//                   header("Location: profile.php");
//                   exit(0);
//               }
//           } else {
//               $_SESSION['status'] = "Image upload failed";
//               header("Location: profile.php");
//               exit(0);
//           }
//       }
//   } else {
//       $_SESSION['status'] = "Validation failed. Please check the form for errors.";
//       header("Location: profile.php");
//       exit(0);
//   }
// }


?>