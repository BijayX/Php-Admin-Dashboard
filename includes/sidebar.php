<?php
include('config/dbconn.php');
// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    // Start the session
    session_start();

}
$username4 = '';
if (isset($_SESSION['auth_user']['user_id'])) {
  $username4 = $_SESSION['auth_user']['user_id'];
} else {
  echo '<a href="#" class="d-block">79</a>';
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="profile.php" class="brand-link">
      <img src="upload\profile\logo-high-resolution-logo-transparent.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
        <?php
             $query = "SELECT * FROM user WHERE id='$username4'";
             $result = mysqli_query($con, $query);

             while ($data = mysqli_fetch_assoc($result)) {
              ?>
                <img  class="img-circle" src="./upload/profile/<?php echo $data['image']; ?>" width="60" height="" alt="Profile Image">

                <a href="profile.php" class="user-link">
                   <strong class="user-name"><?php echo htmlspecialchars($data['name']); ?></strong>
              </a>

                <?php
             }
            ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Collection
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="product.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
           
         
          <li class="nav-header">Settings</li>
          <li class="nav-item">
    <a href="profile.php" class="nav-link">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>
            Admin Profile
        </p>
    </a>
</li>

  <li class="nav-item">
    <a href="registered.php" class="nav-link">
        <i class="nav-icon fas fa-user-plus"></i>
        <p>
            Register Users
        </p>
    </a>
     </li>

    <li class="nav-item">
        <a href="attendance_sheet.php" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>
                Attendance Sheet
            </p>
        </a>
    </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
         
          

         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>