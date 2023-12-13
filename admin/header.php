<?php include('connect.php'); ?>

<body>
<?php
$sql = "SELECT * FROM tbl_admin_user WHERE userid = '".$_SESSION["userid"]."'";
$result = $conn->query($sql);
$ro = mysqli_fetch_array($result);

// Check if a profile image exists for the System Admin
if ($_SESSION['user'] == 'tbl_admin_user') {
    $profile_sql = "SELECT profile_photo FROM tbl_admin_user WHERE userid = '".$_SESSION["userid"]."'";
    $profile_result = $conn->query($profile_sql);

        if (!$profile_result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }
    
    $profile_data = mysqli_fetch_array($profile_result);
    $profile_image = isset($profile_data['profile_photo']) ? $profile_data['profile_photo'] : 'default_image.jpg';
}
?>


  <div class="theme-loader">
    <div class="ball-scale">
      <div class='contain'>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="pcoded" class="pcoded">
  <div class="pcoded-overlay-box"></div>
  <div class="pcoded-container navbar-wrapper">
  <nav class="navbar header-navbar pcoded-header" style="background-color: #f5f5f5; color: #404e67">
      <div class="navbar-wrapper">
        <div class="navbar-logo" style="background-color: #0a4b78 ;">
            <a class="mobile-options">
              <i class="feather icon-more-horizontal"></i>
            </a>
          </div>
          <div class="navbar-container container-fluid">
            <ul class="nav-left">
              <li></li>
            </ul>
            <ul class="nav-right">
              <li class="user-profile header-notification">
              <div class="dropdown-toggle" data-toggle="dropdown">
              <img class="img-radius" alt="User-Profile-Image" src="<?php echo $profile_image ?>" style="border-radius: 50%; width: 45px; height: 45px; object-fit: cover;">



              


                    <span>
                      <?php
                      echo ($_SESSION['user'] == 'tbl_admin_user' ? " " : "") . $_SESSION['firstname'];
                      ?>
                    </span>
                      <i class="feather icon-chevron-down"></i>
                    </div>

                  <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li>
                      <a href="profile.php">
                        <i class="feather icon-user"></i> Profile
                      </a>
                    </li>
                    <li>
                      <a href="changepassword.php">
                        <i class="feather icon-edit"></i> Security
                      </a>
                    </li>
                    <li>
                      <a href="logout.php">
                        <i class="feather icon-log-out"></i> Logout
                     </a>
                  </li>
                </ul>
              </div>
             </li>
          </ul>
        </div>
    </div>
</nav>
