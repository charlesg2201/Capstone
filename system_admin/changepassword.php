<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_POST["btn_changepass"])) {
    // Extracting values from the form
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new password and confirm password match
    if ($new_password == $confirm_password) {
        // Fetch the old password from the database
        $stmt = $conn->prepare("SELECT password FROM tbl_admin WHERE id = ?");
        $stmt->bind_param("i", $_SESSION["id"]);
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
                $update_query = "UPDATE tbl_admin SET password = '$new_password' WHERE id = '".$_SESSION["id"]."'";
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
            $_SESSION['error'] = "New password cannot be the same as the old password.";
        }
    } else {
        $_SESSION['error'] = "Passwords do not match. Please try again.";
    }
}
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-##############" crossorigin="anonymous" />

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
</head>
<?php
if($_SESSION['user'] == 'tbl_admin'){
    $que = "select * from  tbl_admin where id = '".$_SESSION["id"]."'";
    $query = $conn->query($que);
    while($row = mysqli_fetch_array($query)) {
        extract($row);

        $password = $row['password'];
    }
}
?>

<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Security Details</h4></div>
                        <div class="card-block">
                                    <form id="main" method="post" enctype="multipart/form-data">
                                        <br>
                                        <br>
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
                                            <?php echo "<script>setTimeout(\"location.href = 'changepassword.php';\",1500);</script>"; ?>
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
                                            <?php echo "<script>setTimeout(\"location.href = 'changepassword.php';\",2500);</script>"; ?>
                        
                                            
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
