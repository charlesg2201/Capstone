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
            <div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
 <i class="feather icon-home"></i>
</li>
<li class="breadcrumb-item"><a href="index.php">Home</a>
</li>
<li class="breadcrumb-item"><a href="studentdetails.php">Profile</a>
</li>
</ul>
</div>
</div>
</div>
</div>
            <div class="page-body">
                <div class="card">
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold">
                    <h4><i class="fa fa-info-circle"></i> Personal Details</h4>
                    </div>
                    <div class="card-block">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <?php
                               $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
                               $qsqlpatient = mysqli_query($conn, $sqlpatient);
                               $patient = mysqli_fetch_array($qsqlpatient);
                                ?>
                                <table class="table table-hover">
                                    <tr>
                                        <th>LRN Number :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['lrn_number']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>First Name :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['fname']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['lname']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Middle Name :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['mname']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number:</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['contact_number']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Email Address :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['email']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth:</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['dob']; ?>" readonly></td>
                                    </tr>
                                </table>
                            </div>
                
              
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Gender :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['gender']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Strand :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['strand']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Grade Level:</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['grade_level']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Section :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['section']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Address :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['address']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Guardian :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['guardian_name']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Guardian's Contact Number :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $patient['contact']; ?>" readonly></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
      


</div>
</div>
</div>
</div>
</div>
</div>
         
</html>
<?php include('footer.php'); ?>
