
<?php include('head.php');
include('connect.php');
?>

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



<section class="login-block">

<div class="container-fluid">
<div class="row">
<div class="col-sm-12">

<form class="" action="sendpass.php" method="post" class="md-float-material form-material">

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
<input type="email" name="email" class="form-control" required="" placeholder="Enter your active email address">
<span class="form-bar"></span>
</div>
<div class="row">
<div class="col-md-12">
<button type="submit" name="send" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">Submit</button>
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
