<?php
  
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   include('config/dbconn.php');
   if (!isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You need to log in first";
    $_SESSION['status_code']="error";
    header('Location: login1.php');
    exit();
}

?>
 <div class="content-wrapper">
 <div class="modal fade" id="AdduserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Attendance_sheet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Attendance of Users</li>
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
                <h3 class="card-title">Attendance of Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Starts</th>
                    <th>Ends/Time Out</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                             $query="SELECT *FROM attendance";
                             $query_run=mysqli_query($con,$query);
                             if(mysqli_num_rows($query_run)>0){
                                  foreach($query_run as $atd){
                                    ?>
                                     <tr>
                                        <td><?= $atd['id'];?></td>
                                        <td><?= $atd['name'];?></td>
                                        <td><?= $atd['phone'];?></td>
                                        <td><?= $atd['time_in'];?></td>
                                        <td><?= $atd['time_out'];?></td>  

                                      </tr>
                                    
                                    <?php

                                  }
                             }
                             else{
                                 ?>
                                 <tr>
                                  <td colspan="6">No Record Found</td>
                                 </tr>
                                <?php
                             }
          
                            ?>
                          </tbody>
                        </table>
                 
                  </tbody>
        </table>
         </div>
      </div>
     </div>
   </div>
  </div>
</section>
</div>
<?php   include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>