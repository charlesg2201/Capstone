<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="popup_style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<head>
<title>Patient</title>


<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body>



<?php
  include('connect.php');
  extract($_POST);
if(isset($_POST['btn_login']))
{
  
//echo $pass;
  if($_POST['user'] == 'patient'){    
    $sql = "SELECT * FROM patient WHERE studentid='" .$email . "' and password = '". $password."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);
    //print_r($row);    
    $_SESSION["patientid"] = $row['patientid'];
     $_SESSION["id"] = $row['patientid'];
     $_SESSION["password"] = $row['password'];
     $_SESSION["email"] = $row['studentid'];
     $_SESSION["firstname"] = $row['fname'];
     $_SESSION['user'] = $_POST['user'];
  }
    //print_r($row);
     $count=mysqli_num_rows($result);
     if($count==1 && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
    {       
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
}
else {?>
     <div class="popup popup--icon -error js_error-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Error 
        </h3>
        <p>Invalid Username or Password</p>
        <p>
          <a href="login_patient.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
        </p>
      </div>
    </div>

<?php
      }
    
   }
?>




<section class="login-block">

<div class="container-fluid">
<div class="row">
<div class="col-sm-12">



<div class="auth-box card" style="background-color: rgba(255, 255, 255, 0.5);">
  <div class="text-center">
<image class="profile-img" src="uploadImage/Logo/shslogo.png" style="width: 30%; margin-top: 20px; border-radius: 50%;"></image>
    </div> 
<div class="card-block" >
<div class="row m-b-20">
<div class="col-md-12">
<h5 class="text-center txt-primary" style="font-weight: bold; color: black;">Physical and Health Assessment System in Senior High School Clinic of City College of Tagaytay</h5>

</div>
</div>
  <form method="POST" >
    <div class="form-group form-primary">      
    <select name="user" required="" class="hidden-select" style="visibility: hidden;">
        <option value="patient">Patient</option>
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
    </section>

</body>
</html>
