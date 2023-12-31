<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Users</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
        <?php
            if (isset($_SESSION['auth_user']['user_name'])) {
                $userDisplayName = $_SESSION['auth_user']['user_name'];
                echo '<a href="#" class="d-block">' . $userDisplayName . '</a>';
            } else {
                echo '<a href="#" class="d-block">Hello</a>';
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
          <li class="nav-header">Settings</li>
          <li class="nav-item">
    <!-- <a href="pages/calendar.html" class="nav-link">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>
            User's Profile
            <span class="badge badge-info right">2</span>
        </p>
    </a> -->
</li>

  
     <li class="nav-item">
    <a href="attendance.php" class="nav-link">
        <i class="nav-icon fas fa-user-tag"></i>
        <p>
            Attendance
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