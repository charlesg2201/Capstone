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

<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i> Home</a></li>
<li class="breadcrumb-item">Profile</a></li>

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
                    <?php
                    if(isset($_POST["btn_changepass"])) {
    // Extracting values from the form
    $old_password = $_POST['old_password'];
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['confirm_password'];

    $stmt = $conn->prepare("SELECT password FROM patient WHERE patientid = ?");
    $stmt->bind_param("i", $_SESSION["patientid"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_password_db = $row['password'];
    // Check if new password and confirm password match
    if ($old_password == $old_password_db) {
        if ($new_password == $confirm_password) {
            // Fetch the old password from the database
            $stmt = $conn->prepare("SELECT password FROM patient WHERE patientid = ?");
            $stmt->bind_param("i", $_SESSION["patientid"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $old_password = $row['password'];

            // Check if the new password is different from the old one
            if ($new_password != $old_password) {
                // Validate password strength
                if (preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s])[\w\W]{8,}$/', $new_password)) {
                    // Password meets complexity requirements
                    // Update password in the database (plaintext)
                    $update_query = "UPDATE patient SET password = '$new_password' WHERE patientid = '".$_SESSION["patientid"]."'";
                    if ($conn->query($update_query) === TRUE) {
                        $_SESSION['success'] = "Password changed successfully!";
                    } else {
                        $_SESSION['error'] = "Error updating password: " . $conn->error;
                    }
                } else {
                    // Password complexity requirements not met
                    // Check for specific conditions and set separate error messages
                    if (strlen($new_password) < 8) {
                        $_SESSION['error'] = "Password should be at least 8 characters long.";
                    }
                    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s])[\w\W]*$/', $new_password)) {
                        $_SESSION['error'] = "Password should contain at least one capital letter, one number, and one special character.";
                    }
                    if (preg_match('/\s/', $new_password)) {
                        $_SESSION['error'] = "Spaces are not allowed in the password.";
                    }
                }
            } else {
                $_SESSION['error'] = "New password cannot be the same as the old password. Please try again.";
            }
        } else {
            $_SESSION['error'] = "New Password do not match. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Old password is wrong. Please try again.";
    }
}
?>

<?php
if($_SESSION['user'] == 'patient'){
    $que = "select * from  patient where patientid = '".$_SESSION["patientid"]."'";
    $query = $conn->query($que);
    while($row = mysqli_fetch_array($query)) {
        extract($row);

        $password = $row['password'];
    }
}
?>


         

                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Change Password</h4></div>
                        <div class="card-block">
                                    <form id="main" method="post" enctype="multipart/form-data">
                                        <br>
                                        <br>
                                        <div class="form-group row">
    <label class="col-sm-2 col-form-label">Old Password</label>
    <div class="col-sm-3">
        <input class="form-control" type="password" name="old_password" id="old_password" required/>
        <span class="messages"></span>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">New Password</label>
    <div class="col-sm-3">
        <input class="form-control" type="password" name="newpassword" id="newpassword" required/>
        <span class="messages"></span>
    </div>
        <label class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-3">
        <div class="input-group">
        <input class="form-control" type="password" name="confirm_password" id="confirm_password" required/>
    </div>
    <span class="messages"></span>
        </div>

        
    </div>

    
<?php  ?>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
<button type="submit" name="btn_changepass" id="editButton" class="btn btn-primary m-b-0">Change Password</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php include('footer.php'); ?>
                            <link rel="stylesheet" href="popup_style.css">
                           
                             <?php if(!empty($_SESSION['success'])) {  ?>
                                <div class="popup popup--icon -success js_success-popup popup--visible">
                                    <div class="popup__background"></div>
                                    <div class="popup__content">
                                        <h3 class="popup__content__title">
                                            Success
                                        </h3>
                                        <p><?php echo $_SESSION['success']; ?></p>
                                        <p>
                                            <?php echo "<script>setTimeout(\"location.href = 'studentdetails.php';\",1500);</script>"; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php unset($_SESSION["success"]); ?>
                            <?php } ?>
                            <?php if(!empty($_SESSION['error'])) {  ?>
                                <div class="popup popup--icon -error js_error-popup popup--visible">
                                    <div class="popup__background"></div>
                                    <div class="popup__content">
                                        <h3 class="popup__content__title">
                                            Error
                                        </h3>
                                        <p><?php echo $_SESSION['error']; ?></p>
                                        <p>
                                            <?php echo "<script>setTimeout(\"location.href = 'studentdetails.php';\",2500);</script>"; ?>
                        
                                            
                                        </p>
                                    </div>
                                </div>
                                <?php unset($_SESSION["error"]);  } ?>
                           
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
</div>
</div>
</div>
</div>
         
</html>
<?php include('footer.php'); ?>
