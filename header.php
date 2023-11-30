<?php include('connect.php'); ?>

<body>
<?php
$que = "SELECT * FROM manage_website";
$query = $conn->query($que);
while ($row = mysqli_fetch_array($query)) {
  extract($row);
  $logo = $row['logo'];
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
        <div class="navbar-logo" style="background-color:#0a4b78;">
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
              <div class="dropdown-primary dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                  <?php
                  if ($_SESSION['user'] == 'admin') {
                  ?>
                  <img src="uploadImage/Profile/<?php echo $_SESSION['image']; ?>" class="img-radius" alt="User-Profile-Image" style="border-radius: 50%" />
                  <?php } ?>
                  <span><?php echo $_SESSION['firstname']; ?></span>
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
                      <i class="feather icon-edit"></i> Change Password
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
