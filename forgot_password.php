
<?php include('head.php');?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Student</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">



<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body class="fix-menu">

<<?php
  include('connect.php');
  extract($_POST);
if(isset($_POST['btn_forgot']))
{
    $sql = "SELECT * FROM patient WHERE studentid='".$studentid."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);
    
     $_SESSION["id"] = $row['patientid'];
     $_SESSION["password"] = $row['password'];
     $_SESSION["username"] = $row['studentid'];
     $_SESSION["firstname"] = $row['fname'];

     $count=mysqli_num_rows($result);
     if($count==1 && isset($_SESSION["username"])) {
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
             <?php echo "<script>setTimeout(\"location.href = 'resetpass.php?patientid=$row[patientid]';\",1500);</script>"; ?>
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
        <p>Invalid Username</p>
        <p>
          <a href="forgot_password.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
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

<form method="POST" class="md-float-material form-material">

<div class="auth-box card">
  <br>
<div class="text-center">
 <image class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 30%; border-radius: 50%"></image>
</div>
<div class="card-block">
<div class="row m-b-20">
<div class="col-md-12">
<h3 class="text-center">Recover your password</h3>
</div>
</div>
<div class="form-group form-primary">
<input type="text" name="studentid" class="form-control" required="" placeholder="Enter your username">
<span class="form-bar"></span>
</div>
<div class="row">
<div class="col-md-12">
<button type="submit" name="btn_forgot" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">Reset Password</button>
</div>
 </div>
<br>
<br>
<br>
<br>

</div>
</div>
</div>
</div>
</form>

</div>

</div>

</div>

</section>

<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>

<script type="text/javascript" src="../files/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="../files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="../files/assets/js/common-pages.js"></script>


</body>

<!-- for any PHP, Laravel or Codeignitor Develoopment connect me at mayuri.infospace@gmail.com-->
</html>
