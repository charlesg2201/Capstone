
<?php include('head.php');?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Admin</title>

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
if(isset($_POST['btn_submit']))
{
    $sql = "SELECT * FROM tbl_admin_user WHERE security_question='".$security_question."' AND security_answer='".$security_answer."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);
    
     $_SESSION["userid"] = $row['userid'];
     $_SESSION["password"] = $row['password'];
     $_SESSION["email"] = $row['username'];
     $_SESSION["firstname"] = $row['firstname'];
     $_SESSION['security_question'] = $row['security_question'];
     $_SESSION['security_answer'] = $row['security_answer'];

     $count=mysqli_num_rows($result);
     if($count==1 && isset($_SESSION["security_question"]) && isset($_SESSION["security_answer"])) {
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
             <?php echo "<script>setTimeout(\"location.href = 'confirmpass.php?userid=".$_SESSION["userid"]."';\",1500);</script>"; ?>
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
        <p>Invalid Security Question or Security Answer</p>
        <p>
          <a href="resetpass.php?userid=<?php echo $_GET['userid'] ?>"><button class="button button--error" data-for="js_error-popup">Close</button></a>
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
    <select name="security_question" id="security_question" class="form-control" required="">
    <option value="">-- Select One -- </option>
                        <option value="What is your fathers name?" <?php if(isset($_GET['editid']))
                            { if($rsedit['security_question'] == 'What is your fathers name?') { echo 'selected'; } } ?>>What is your fathers name?</option>
                        <option value="What is your birth month?" <?php if(isset($_GET['editid']))
                            { if($rsedit['security_question'] == 'What is your birth month?') { echo 'selected'; } } ?>>What is your birth month?</option>
                    </select>
    <br>
    <input class="form-control" type="text" name="security_answer" id="security_answer" placeholder="Enter your security answer"
    value="<?php if(isset($_GET['editid'])) { echo $rsedit['security_answer']; } ?>" />

    <span class="form-bar"></span>



</div>
<div class="row">
<div class="col-md-12">
<button type="submit" name="btn_submit" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">Submit</button>
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
