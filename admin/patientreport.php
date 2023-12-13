<!DOCTYPE html>
<html lang="en">

<style>
      .box-header {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50px; /* Set your desired height */
  background-color: #0a4b78;
  color: white;
  font-weight: bold;
}

.box-header h4 {
  margin: 0;
}                  
</style>
<?php date_default_timezone_set("Asia/Manila"); ?>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btnsubmit']))

?>
    
<?php
if(isset($_GET['id']))
{ ?>

<?php } ?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-body">
                <div class="card">
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold">
                        <h4>Student Details</h4>
                    </div>
                    <div class="card-block">

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <?php
                                $sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
                                $qsqlpatient = mysqli_query($conn, $sqlpatient);
                                $rspatient = mysqli_fetch_array($qsqlpatient);
                                ?>

                <table class="table table-hover">
                    <tr>
                        <th>LRN Number :</th>
                        <td>&nbsp;<?php echo $rspatient['lrn_number']; ?></td>
                    </tr>
                    <tr>
                        <th>First Name :</th>
                        <td>&nbsp;<?php echo $rspatient['fname']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name :</th>
                        <td>&nbsp;<?php echo $rspatient['lname']; ?></td>
                    </tr>
                    <tr>
                        <th>Middle Name :</th>
                        <td>&nbsp;<?php echo $rspatient['mname']; ?></td>
                    </tr>
                    <tr>
                        <th>Contact Number:</th>
                        <td>&nbsp;<?php echo $rspatient['contact_number']; ?></td>
                    </tr>
                    <tr>
                        <th>Email Address :</th>
                        <td>&nbsp;<?php echo $rspatient['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td>&nbsp;<?php echo $rspatient['dob']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                                <table class="table table-hover">
                    <tr>
                        <th>Gender :</th>
                        <td>&nbsp;<?php echo $rspatient['gender'];?></td>
                    </tr>
                        <tr>
                        <th>Strand :</th>
                        <td>&nbsp;<?php echo $rspatient['strand']; ?></td>
                    </tr>
                    <tr>
                        <th>Grade Level:</th>
                        <td>&nbsp;<?php echo $rspatient['grade_level']; ?></td>
                    </tr>
                    <tr>
                        <th>Section :</th>
                        <td>&nbsp;<?php echo $rspatient['section']; ?></td>
                    </tr>
                    <tr>
                        <th>Address :</th>
                        <td>&nbsp;<?php echo $rspatient['address']; ?></td>
                    </tr>
                    <tr>
                        <th>Guardian :</th>
                        <td>&nbsp;<?php echo $rspatient['guardian_name']; ?></td>
                    </tr>
                        <tr>
                        <th>Guardian's Contact Number :</th>
                        <td>&nbsp;<?php echo $rspatient['contact']; ?></td>
                    </tr>
                    
                </table>
                        </div>
                     </div>
                     </div>
                </div>
            </div>
        </div>
             <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Security Details</h4></div>
                        <div class="card-block">
                        <form id="main" method="post" action="" enctype="multipart/form-data">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
    <div class="form-group row">
                  <?php
                    $sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
                    $qsqlpatient = mysqli_query($conn,$sqlpatient);
                    $rspatient=mysqli_fetch_array($qsqlpatient);
                  ?>

                  <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-hover">
                      <tbody>
                      <tr>
                          <th>Username :</th>
                          <td>&nbsp;<?php echo $rspatient['studentid']; ?></td>
                      </tr>
                      <tr>
                          <th>Password :</th>
                          <td>&nbsp;<?php echo $rspatient['password']; ?></td>
                      </tr>
                     
                      </tbody>
                    </table>
                  </div>
                  </p>
              </div>
              <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Admission Record</h4></div>
                        <div class="card-block">
                        <form id="main" method="post" action="" enctype="multipart/form-data">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
    <div class="form-group row">
                    <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                      <thead>
                        <tr>
                          <th>Admission Date</th>
                          <th>Admission Time</th>
                          <th>Reason</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = "SELECT * FROM tbl_admission where patientid='$_GET[patientid]'";
                          $qsql = mysqli_query($conn, $sql);
                          while($rs = mysqli_fetch_array($qsql))
                          {
                            echo "<tr>
                              <td>$rs[admission_date]</td>
                              <td>$rs[admission_time]</td>
                              <td>$rs[reasons]</td>
                              <td>$rs[remarks]</td></tr>";
                          }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                        </tr>
                      </tfoot>
                    </table>
                    <?php
                      if(isset($_SESSION['userid']))
                          {
                            echo "<a href='newadmission.php?editid=$_GET[patientid]' class='btn btn-primary'>Add New Admission</a>";
                          }
                    ?>
                    </div>
                    
                  </p>
              </div>
                        </div>
                        </div>

<div id="#">
</div>
</div>
</div>
</div>
</div>
</div>
         
</html>
<?php include('footer.php'); ?>
