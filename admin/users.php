<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="UPDATE tbl_admin_user SET firstname='$_POST[firstname]',lastname='$_POST[lastname]',contact='$_POST[contact]',username='$_POST[username]',gender='$_POST[gender]',status='$_POST[status]',address='$_POST[address]' WHERE userid='$_GET[editid]'";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success 
                </h3>
                <p>User Record Updated Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'view-user.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }   
    }
    else
    {
        $passw = hash('sha256', $_POST['password']);
        function createSalt()
        {
            return '2123293dsj2hu2nikhiljdsd';
        }
        $salt = createSalt();
        $pass = hash('sha256', $salt . $passw);
        $sql ="INSERT INTO tbl_admin_user(firstname,lastname,contact,username,password,gender,status,address) values('$_POST[firstname]','$_POST[lastname]','$_POST[contact]','$_POST[username]','$pass','$_POST[gender]','$_POST[status]','$_POST[address]')";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success 
                </h3>
                <p>User Record Inserted Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'view-user.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
}
if(isset($_GET['editid']))
{
    $sql="SELECT * FROM tbl_admin_user WHERE userid='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);
    
}

?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">

<!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a href="add_user.php">User</a>
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
<!-- <h5>Basic Inputs Validation</h5>
<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
</div>
<div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['firstname']; } ?>" >
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['lastname']; } ?>" >
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Contact Number</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" name="contact" id="contact"
               value="<?php if(isset($_GET['editid'])) { echo $rsedit['contact']; } ?>"
               oninput="validateContactNumber()" required />
        <span class="messages"></span>
    </div>

<script>
    function validateContactNumber() {
        var contactField = document.getElementById("contact");
        var contactValue = contactField.value;

        // Use a regular expression to check for only numbers
        var regex = /^[0-9]+$/;

        if (!regex.test(contactValue)) {
            alert("Please enter a valid contact number.");
            contactField.value = "";
        }
    }
</script>

<?php 
  if(!isset($_GET['editid']))
  {
?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
            <input class="form-control" type="password" name="password" id="password"/>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
            <input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword"/>
            <span class="messages" id="confirm-pw" style="color: red;"></span>
        </div>
    </div>
<?php } ?>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Gender</label>
        <div class="col-sm-4">
            <select name="gender" id="gender" class="form-control" required="">
                <option value="">-- Select One -- </option>
                <option value="Male" <?php if(isset($_GET['editid']))
                    { if($rsedit['gender'] == 'Male') { echo 'selected'; } } ?>>Male</option>
                <option value="Female" <?php if(isset($_GET['editid']))
                    { if($rsedit['gender'] == 'Female') { echo 'selected'; } } ?>>Female</option>
            </select>
        </div>

        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-4">
            <select name="status" id="status" class="form-control" required="">
                <option value="">-- Select One -- </option>
                <option value="Active" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Active') { echo 'selected'; } } ?>>Active</option>
                <option value="Inactive" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Inactive') { echo 'selected'; } } ?>>Inactive</option>
            </select>
            <span class="messages"></span>
        </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <textarea name="address" id="address" class="form-control"><?php if(isset($_GET['editid'])) { echo $rsedit['address']; } ?></textarea>
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php');?>

<script type="text/javascript">
    $('#main').keyup(function(){
        $('#confirm-pw').html('');
    });

    $('#cnfirmpassword').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });

    $('#password').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });
</script>