<?php
   session_start();
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   include('config/dbconn.php');

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit-Registered Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    <section class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              
    <!-- /.content-header -->
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit-Registered Users</h3>
                <a href="registered.php"  class="btn btn-danger btn-sm float-right">Back</a>
              </div>
               <!-- /.card-header -->
               <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <?php
                                if(isset($_GET['user_id'])){
                                    $user_id= $_GET['user_id'];
                                    $query="SELECT * FROM users WHERE id='$user_id' LIMIT 1 ";
                                    $query_run=mysqli_query($con,$query);
                                    if(mysqli_num_rows($query_run)>0){
                                        foreach($query_run as $row){
                                            ?>
                                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="name">
                                                </div>
                                            <div class="form-group">
                                                <label for="">Phone Number </label>
                                                <input type="text" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" placeholder="phone number">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email Id</label>
                                                <input type="email"  name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password"  name="password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="password">
                                            </div>
                                            <?php
                                        }
                                    }
                                    else{
                                         echo "<h4>No Record Found.!</h4>";
                                    }
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                        <button type="submit"  name ="UpdateUser"class="btn btn-info">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
              </div>
      </div>
     </div>
   </div>
  </div>
</section>
</div>
<?php   include('includes/script.php'); ?>

<?php include('includes/footer.php'); ?>