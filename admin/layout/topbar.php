  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->


    <!-- Nav Item - Alerts -->
  

    <!-- Nav Item - Messages -->
  

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?echo $_SESSION['user']->name?></span>
            <img class="img-profile rounded-circle"
                src="../assets/admin/img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="index.php?page=users-profile">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
           
          
            <div class="dropdown-divider"></div>
            <form  method="POST">
            <button class="dropdown-item" name="signout_btn" onclick="return confirm('Are you sure to delete')">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Signout
                </button>
            </form>
        </div>
    </li>

</ul>

</nav>

<?php
if(isset($_POST['signout_btn'])){
  session_destroy();

  header("location:../index.php");
}
?>
<!-- End of Topbar -->