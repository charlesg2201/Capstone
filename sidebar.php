 <?php
 include('connect.php');
  $sql = "SELECT * from patient where patientid = '".$_SESSION["patientid"]."'";
        $result=$conn->query($sql);
        $ro=mysqli_fetch_array($result);

 ?>
<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<nav class="pcoded-navbar" >
<div class="text-center" style="background-color:#0a4b78">
<br>
<img class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 40%; border-radius: 50%">
</div>
<div class="pcoded-inner-navbar main-menu" style="background-color: #0a4b78">
    <br>
<?php if(($_SESSION['user'] == 'patient')){ ?>
<div style="text-align: center; color: white">Student</div>
<?php } ?>
<ul class="pcoded-item pcoded-left-item">
<li class="">
<a href="index.php">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Dashboard</span>
</a>
</li>

<li class="pcoded-hasmenu">
    <a href="studentdetails.php ">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Profile</span>
    </a>
</li>
<li class="pcoded-hasmenu">
<a href="admissionrecord.php?patientid=<?php echo $_SESSION["patientid"]; ?>">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Admission Record</span>
    </a>
</li>

<?php if($_SESSION['user'] == 'patient') { ?>
<li class="pcoded-hasmenu">
    <a href="physical_assessment.php ">
        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
        <span class="pcoded-mtext">Physical Assessment</span>
    </a>
</li>

<li class="pcoded-hasmenu">
    <a href="health_assessment.php ">
        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
        <span class="pcoded-mtext">Health Assessment</span>
    </a>
</li>

<li class="pcoded-hasmenu">
    <a href="assessment_remarks.php ">
        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
        <span class="pcoded-mtext">Assessment Remarks</span>
    </a>
</li>

<li class="pcoded-hasmenu">
    <a href="messages.php?patientid=<?php echo $_SESSION["patientid"]; ?>">
        <span class="pcoded-micon"><i class="feather icon-mail"></i></span>
        <span class="pcoded-mtext">Message</span>
    </a>
</li>



<?php } ?>


</ul>
</div>
</nav>
