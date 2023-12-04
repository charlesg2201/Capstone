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
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Personal Details</span>
    </a>
</li>
<li class="pcoded-hasmenu">
    <a href="admissionrecord.php ">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Admission Record</span>
    </a>
</li>

<?php if($_SESSION['user'] == 'patient') { ?>
<li class="pcoded-hasmenu">
    <a href="takeassessment.php ">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Assessment</span>
    </a>
</li>

<li class="pcoded-hasmenu">
    <a href="assessment.php ">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Physical Assessment</span>
    </a>
</li>

<li class="pcoded-hasmenu">
    <a href="assessment.php ">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Health Assessment</span>
    </a>
</li>


<?php } ?>


</ul>
</div>
</nav>
