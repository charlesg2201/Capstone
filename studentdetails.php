<title>Patient</title>
<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
$qsqlpatient = mysqli_query($conn, $sqlpatient);
$patient = mysqli_fetch_array($qsqlpatient);
?>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-10">
<div class="page-header-title">
<div class="d-inline">

</div>
</div>
</div>

</div>
<div class="card">
<div class="card-block">
  <div class="row">
      <div class="col-lg-12">
                        <ul class="nav nav-tabs md-tabs b-none" role="tablist">
                        <li class="active">About Me</li>
            <!-- <li><a href="#">Family Background</a></li> -->
        </ul>
        <hr>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row text-xs">
                        <legend><i class="fa fa-info-circle"></i> Personal Details</legend>
                                <div class="col-md-6">
</div>

                        <div class="tab-content card-block">
    <div class="tab-pane active" id="home3" role="tabpanel">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover">
                    <tr>
                        <th>LRN Number :</th>
                        <td>&nbsp;<?php echo $patient['lrn_number']; ?></td>
                    </tr>
                    <tr>
                        <th>First Name :</th>
                        <td>&nbsp;<?php echo $patient['fname']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name :</th>
                        <td>&nbsp;<?php echo $patient['lname']; ?></td>
                    </tr>
                    <tr>
                        <th>Middle Name :</th>
                        <td>&nbsp;<?php echo $patient['mname']; ?></td>
                    </tr>
                    <tr>
                        <th>Contact Number:</th>
                        <td>&nbsp;<?php echo $patient['contact_number']; ?></td>
                    </tr>
                    <tr>
                        <th>Email Address :</th>
                        <td>&nbsp;<?php echo $patient['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td>&nbsp;<?php echo $patient['dob']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 justify-content-md-end">
                <table class="table table-hover">
                    <tr>
                        <th>Gender :</th>
                        <td>&nbsp;<?php echo $patient['gender'];?></td>
                    </tr>
                        <tr>
                        <th>Strand :</th>
                        <td>&nbsp;<?php echo $patient['strand']; ?></td>
                    </tr>
                    <tr>
                        <th>Grade Level:</th>
                        <td>&nbsp;<?php echo $patient['grade_level']; ?></td>
                    </tr>
                    <tr>
                        <th>Section :</th>
                        <td>&nbsp;<?php echo $patient['section']; ?></td>
                    </tr>
                    <tr>
                        <th>Address :</th>
                        <td>&nbsp;<?php echo $patient['address']; ?></td>
                    </tr>
                    <tr>
                        <th>Guardian :</th>
                        <td>&nbsp;<?php echo $patient['guardian_name']; ?></td>
                    </tr>
                        <tr>
                        <th>Guardian's Contact Number :</th>
                        <td>&nbsp;<?php echo $patient['contact']; ?></td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>
