<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="popup_style.css">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    
<head>
<title>System Admin</title>


<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body>



<?php
include('connect.php');
extract($_POST);

if (isset($_POST['btn_login'])) {
    if ($_POST['user'] == 'tbl_admin') {
        $sql = "SELECT * FROM tbl_admin WHERE username='" . $email . "' and password = '" . $password . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if ($row) {
            if ($row['delete_status'] == 1) {
                // Account is deactivated
                ?>
                <div class="popup popup--icon -error js_error-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">
                            Error
                        </h3>
                        <p>Your account is deactivated.</p>
                        <p>
                            <a href="login_admin.php"><button class="button button--error"
                                    data-for="js_error-popup">Close</button></a>
                        </p>
                    </div>
                </div>
            <?php
            } else {
                // Account is active, proceed with login
                $_SESSION["adminid"] = $row['id'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["password"] = $row['password'];
                $_SESSION["email"] = $row['username'];
                $_SESSION["firstname"] = $row['firstname'];
                $_SESSION["lname"] = $row['lname'];
                $_SESSION['user'] = $_POST['user'];
                ?>
                <div class="popup popup--icon -success js_success-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">
                            Success
                        </h3>
                        <p>Login Successfully</p>
                        <p>
                            <?php echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>"; ?>
                        </p>
                    </div>
                </div>
            <?php
            }
        } else {
            // Invalid Username or Password
            ?>
            <div class="popup popup--icon -error js_error-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                    <h3 class="popup__content__title">
                        Error
                    </h3>
                    <p>Invalid Username or Password</p>
                    <p>
                        <a href="login_admin.php"><button class="button button--error"
                                data-for="js_error-popup">Close</button></a>
                    </p>
                </div>
            </div>
        <?php
        }
    }
}
?>

<?php
$que="select * from manage_website";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
  //print_r($row);
  extract($row);
  
  $logo = $row['logo'];
}
?>


<section class="login-block">

<div class="container-fluid">
<div class="row">
<div class="col-sm-12">



<div class="auth-box card" style="background-color: rgba(255, 255, 255, 0.5);">
  <div class="text-center">
<image class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 30%; margin-top: 20px; border-radius: 50%;"></image>
    </div> 
<div class="card-block" >
<div class="row m-b-20">
<div class="col-md-12">
<h5 class="text-center txt-primary" style="font-weight: bold; color: black;">Physical and Health Assessment</h5>
</div>
</div>
  <form method="POST" >
    <div class="form-group form-primary">
      
    <select name="user" required="" class="hidden-select" style="visibility: hidden;">
        <option value="tbl_admin"></option>
    </select>
      
    </div>
    <div class="form-group form-primary">
      <input type="text" name="email" class="form-control" required="" placeholder="Username">
      <span class="form-bar"></span>
    </div>
    <div class="form-group form-primary">
      <input type="password" name="password" class="form-control" required="" placeholder="Password">
      <span class="form-bar"></span>
    </div>
    <div class="row m-t-30">
      <div class="col-md-12">
        <button type="submit" name="btn_login" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
      </div>
    </div>
    <div class="row m-t-25 text-left">
      <div class="col-12">
        <div class="forgot-phone text-right f-right">
          <a href="forgot_password.php" class="text-right f-w-600"> Forgot Password?</a>
        </div>
      </div>
    </div>
  </form>


</div>
</div>
</div>
</div>
</section>

</body>
</html>
