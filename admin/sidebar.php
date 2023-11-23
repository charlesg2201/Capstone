
<?php
 include('connect.php');
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
 
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar" >
            <div class="d-flex justify-content-center align-items-center" style="background-color: #3498db ; height: 150px;">
                <div style="width: 130px; height: 130px; overflow: hidden; border-radius: 50%;">
                    <img class="profile-img" src="<?php echo $profile_image ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Profile Image">
                </div>
            </div>

<div class="pcoded-inner-navbar main-menu" style="background-color: #3498db ">
    
  <?php if(($_SESSION['user'] == 'tbl_admin_user')){ ?>
<div style="text-align: center; color: white" >Clinic Coordinator</div>
<?php } ?>
<ul class="pcoded-item pcoded-left-item">
<li class="">
<a href="index.php">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Dashboard</span>
</a>
</li>
<?php if($_SESSION['user'] == 'admin') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
        <span class="pcoded-mtext">Users</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="users.php">
                <span class="pcoded-mtext">Add Users</span>
            </a>
        </li>

        <li class="">
            <a href="view-user.php">
                <span class="pcoded-mtext">User Logs</span>
            </a>
        </li>

        
    </ul>
    <?php }?>
</li>
<?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'tbl_admin_user')) { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Student</span>
    </a>
    <ul class="pcoded-submenu">
    <?php if($_SESSION['user'] == 'tbl_admin_user') { ?>
        <li class="">
            <a href="patient.php">
                <span class="pcoded-mtext">Add Student</span>
            </a>
        </li>
    <?php } ?>
        <li class="">
            <a href="view-patient.php">
                <span class="pcoded-mtext">Patient Record</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'tbl_admin_user') { ?>
<li class="pcoded-hasmenu">
<a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Assessment</span>
    </a>
    <ul class="pcoded-submenu">
    <?php if($_SESSION['user'] == 'tbl_admin_user') { ?>
        <li class="">
            <a href="addassessment.php">
                <span class="pcoded-mtext">Add Assessment</span>
            </a>
        </li>
    <?php } ?>
        <li class="">
            <a href="manageassessment.php">
                <span class="pcoded-mtext">Manage Assessment</span>
            </a>
        </li>
        <li class="">
            <a href="examDetails.php">
                <span class="pcoded-mtext">Assessment Result</span>
            </a>
        </li>
    </ul>
</li>

<li class="pcoded-hasmenu">
<a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Print Report</span>
    </a>
    <ul class="pcoded-submenu">
        <li class="">
            <a href="printreport.php">
                <span class="pcoded-mtext">Student List</span>
            </a>
        </li>
        
    </ul>
</li>


<?php } ?>
<?php if($_SESSION['user'] == 'patient') { ?>
<li class="pcoded-hasmenu">
    <a href="takeassessment.php ">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Assessment</span>
    </a>
</li>



<?php } ?>


</ul>
</div>

</nav>
