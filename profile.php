<title>Patient</title>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
if(isset($_POST["btn_update"]))
{
    extract($_POST);

    if($_SESSION['user'] == 'admin'){
      $q1="UPDATE admin SET `fname`='$fname',`loginid`='$email',`mobileno`='$contact' where id = '".$_SESSION["id"]."'";
    }else if($_SESSION['user'] == 'users'){
      $q1="UPDATE users SET `firstname`='$fname',`username`='$email',`contact`='$contact' where doctorid = '".$_SESSION["id"]."'";
    }else if($_SESSION['user'] == 'patient'){
      $q1="UPDATE patient SET `patientname`='$fname',`loginid`='$email',`contact`='$contact' where patientid = '".$_SESSION["patientid"]."'";
    }

    if ($conn->query($q1) === TRUE) {

      $_SESSION['success']='Record Successfully Updated';

} else {

      $_SESSION['error']='Something Went Wrong';
}


  ?>
  <script>

  </script>
  <?php
}

?>

<?php
    if($_SESSION['user'] == 'admin'){
      $que="select * from  admin where id = '".$_SESSION["id"]."'";
      $query=$conn->query($que);
      while($row=mysqli_fetch_array($query))
      {
        //print_r($row);
        extract($row);
        $fname = $row['firstname'];
        $email = $row['username'];
        $contact = $row['contact'];
      }
    }else if($_SESSION['user'] == 'users'){
      $que="select * from  users where userid = '".$_SESSION["id"]."'";
      $query=$conn->query($que);
      while($row=mysqli_fetch_array($query))
      {
        //print_r($row);
        extract($row);
        $fname = $row['firstname'];
        $email = $row['username'];
        $contact = $row['contact'];
      }
    }else if($_SESSION['user'] == 'patient'){
      $que="select * from patient where patientid = '".$_SESSION["patientid"]."'";
      $query=$conn->query($que);
      while($row=mysqli_fetch_array($query))
      {
        //print_r($row);
        extract($row);
        $fname = $row['fname'];
        $email = $row['studentid'];
        $contact = $row['contact'];
      }
    }
?>
   <div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Profile</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>

<li class="breadcrumb-item"><a href="profile.php">Profile</a>
</li>
</ul>
</div>
</div>
</div>
</div>


<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">

</div>
<div class="card-block">
<form id="main" method="post" enctype="multipart/form-data">

<div class="form-group row">
<label class="col-sm-2 col-form-label">Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname; ?>"  placeholder="">
<span class="messages"></span>
</div>

<label class="col-sm-2 col-form-label">Username</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="studentid" name="studentid" value="<?php echo $email; ?>" placeholder="">
<span class="messages"></span>
</div>
</div>


<div class="form-group row">
<label class="col-sm-2 col-form-label">Contact</label>
<div class="col-sm-4">
<input type="tel" class="form-control" id="contact" name="contact" value="<?php echo $contact;?>" placeholder="" minlength="11" maxlength="11" pattern="^[0][1-9]\d{9}$|^[1-9]\d{9}$">
<span class="messages"></span>
</div>

</div>

<div class="form-group row">
<label class="col-sm-2"></label>
<div class="col-sm-10">
<button type="submit" name="btn_update" class="btn btn-primary m-b-0">Update</button>
</div>
</div>
</form>
</div>
</div>

<?php include('footer.php');?>

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
      <!-- <button class="button button--success" data-for="js_success-popup">Close</button> -->
       <?php echo "<script>setTimeout(\"location.href = 'profile.php';\",1500);</script>"; ?>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error
    </h3>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
