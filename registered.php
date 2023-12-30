<?php
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   include('config/dbconn.php');

?>
 <div class="content-wrapper">
 <div class="modal fade" id="AdduserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">Add user</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" placeholder="name">
        </div>
        <div class="form-group">
            <label for="">Phone Number </label>
            <input type="text" name="phone" class="form-control" placeholder="phone number">
        </div>
        <div class="form-group">
            <label for="">Email Id</label>
            <input type="email"  name="email" class="form-control" placeholder="phone">
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label for="">Password</label>
                <input type="password"  name="password" class="form-control" placeholder="password">
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password"  name="confirmpassword" class="form-control" placeholder="Confirm password">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  name ="addUser"class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Register</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Register Users</li>
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
                <h3 class="card-title">Register Users</h3>
                <a href="#" data-toggle="modal" data-target="#AdduserModal" class="btn btn-primary btn-sm float-right">Add User</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query="SELECT *FROM users";
                      $query_run=mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run)>0)
                      {
                         foreach($query_run as $row)
                         {
        
                          ?>
                              <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td> <?php echo $row['name']; ?></td>
                               <td><?php echo $row['phone']; ?></td>
                               <td> <?php echo $row['email']; ?></td>
                               <td>
                                 <a href="registered-edit.php?user_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                 <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                               </td>
                           </tr>
                          <?php
                         }
                      }
                      else
                      {
                        ?>
                        <tr>
                          <td>No Record found</td>
                        </tr>
                        <?php
                      }
                    ?>
                 
                  </tbody>
        </table>
         </div>
      </div>
     </div>
   </div>
  </div>
</section>
</div>

<script>
  $(document).ready(function(){
    $('deletebtn').click(function(e){
      e.preventDefault();
      
      var user_id=$(this).val();
      // console.log(user_id);
      $('.delete_user_id').val(user_id);
      $('#DeleteMOdal').modal('show');
    });
  });
</script>
<?php   include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>