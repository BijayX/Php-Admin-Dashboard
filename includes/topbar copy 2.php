<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index_copy.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link">Contact</a>
        </li>
    </ul>
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search fa-fw"></i></span>
            </div>
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar" type="button">
                    <!-- Your button content, if needed -->
                </button>
            </div>
        </div>
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
            <form action="code.php" method="POST" onsubmit="return confirmLogout()">
                <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
            </form>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
     
</nav>

<script>
    // Function to show the confirmation dialog
    function confirmLogout() {
        return window.confirm("Are you sure you want to logout?");
    }
</script>
