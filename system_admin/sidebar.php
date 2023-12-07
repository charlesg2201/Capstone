<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<?php
include('connect.php');
$sql = "SELECT * FROM tbl_admin WHERE id = '".$_SESSION["id"]."'";
$result = $conn->query($sql);
$ro = mysqli_fetch_array($result);

// Check if a profile image exists for the System Admin
if ($_SESSION['user'] == 'tbl_admin') {
    $profile_sql = "SELECT profile_photo FROM tbl_admin WHERE id = '".$_SESSION["id"]."'";
    $profile_result = $conn->query($profile_sql);

        if (!$profile_result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }
    
    $profile_data = mysqli_fetch_array($profile_result);
    $profile_image = isset($profile_data['profile_photo']) ? $profile_data['profile_photo'] : 'default_image.jpg';
}

?>


<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="d-flex justify-content-center align-items-center" style="background-color: #0a4b78 ; height: 150px;">
                <div style="width: 130px; height: 130px; overflow: hidden; border-radius: 50%;">
                    <img class="profile-img" src="<?php echo $profile_image ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Profile Image">
                </div>
            </div>
<div class="pcoded-inner-navbar main-menu" style="background-color: #0a4b78">

    
  <?php if(($_SESSION['user'] == 'tbl_admin')){ ?>
<div style="text-align: center;" class="pcoded-navigatio-lavel">System Administrator</div>
<?php } ?>
<ul class="pcoded-item pcoded-left-item">
<li class="">
<a href="index.php">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Dashboard</span>
</a>
</li>
<?php if($_SESSION['user'] == 'tbl_admin') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>
        <span class="pcoded-mtext">Clinic Coordinator</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="users.php">
                <span class="pcoded-mtext">Add Clinic Coordinator</span>
            </a>
        </li>

        <li class="">
            <a href="view-user.php">
                <span class="pcoded-mtext">View Users</span>
            </a>
        </li>
    </ul>
    <?php }?>
</li>
</li>
<?php if($_SESSION['user'] == 'tbl_admin') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>
        <span class="pcoded-mtext">System Administrator</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="users-sa.php">
                <span class="pcoded-mtext">Add System Administrator</span>
            </a>
        </li>

        <li class="">
            <a href="view-user-sa.php">
                <span class="pcoded-mtext">View Users</span>
            </a>
        </li>
    </ul>
    <?php }?>
</li>

<?php if($_SESSION['user'] == 'tbl_admin') { ?>
<li class="pcoded-hasmenu">
    <a href="strands.php">
        <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>
        <span class="pcoded-mtext">Strands</span>
    </a>
    
    <?php }?>
</li>

<?php if($_SESSION['user'] == 'tbl_admin') { ?>
<li class="pcoded-hasmenu">
    <a href="academic_year.php">
        <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>
        <span class="pcoded-mtext">Academic Year</span>
    </a>
    
    <?php }?>
</li>

<?php if(($_SESSION['user'] == 'tbl_admin') || ($_SESSION['user'] == 'users')) { ?>
<li class="pcoded-hasmenu">
    <a href="backup.php">
        <span class="pcoded-micon"><iconify-icon icon="feather:database"></iconify-icon></i></span>
        <span class="pcoded-mtext">Backup & Restore</span>
    </a>
    
<?php } ?>


<li>

</a>
</li>
</ul>
</div>
</nav>
