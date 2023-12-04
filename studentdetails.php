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
<div class="col-lg-4">
<div class="page-header-breadcrumb">

</div>
</div>
</div>
</div>


<!-- <h5>DOM/Jquery</h5>
<span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
</div>
<div class="card">
<div class="card-block">
  <div class="row">
      <div class="col-lg-12">
                        <ul class="nav nav-tabs md-tabs b-none" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="studentdetails.php" role="tab">My Details</a>
                                <div class="slide"></div>
                            </li>
                        </ul>

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
