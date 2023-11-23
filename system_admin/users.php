<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

    // Profile photo upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../admin/profile_photos/';
    
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        $uploadedFileName = $uploadDir . uniqid() . '_' . $_FILES['profile_photo']['name'];
    
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadedFileName)) {
            $profilePhoto = mysqli_real_escape_string($conn, $uploadedFileName);
        } else {
            echo "Failed to upload the profile photo.";
            exit;
        }
    }
    

    $checkDuplicateQuery = "SELECT COUNT(*) FROM tbl_admin_user WHERE employee_number = '$employee_number'";
    $result = mysqli_query($conn, $checkDuplicateQuery);
    $row = mysqli_fetch_row($result);
    $count = $row[0];

    if ($count > 0) {
        ?>
			<div class="popup popup--icon -error js_error-popup popup--visible">
			<div class="popup__background"></div>
			<div class="popup__content">
				<h3 class="popup__content__title">
				Error 
				</h3>
				<p>The details you are trying to add already exists.</p>
				<p>
				<a href="users.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
				</p>
			</div>
			</div>
        <?php
    } else {
        if (isset($_GET['editid'])) {
            $sql = "UPDATE tbl_admin_user SET profile_photo='$profilePhoto', firstname='$fname', lastname='$lname', contact='$contact', username='$username', gender='$gender', employee_number='$employee_number'  address='$address' WHERE userid='$_GET[editid]'";
            if ($qsql = mysqli_query($conn, $sql)) {
                // Display success message 
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
        } else {
            // Insert new user record
            $passw = hash('sha256', $_POST['password']);
            function createSalt() {
                return '2123293dsj2hu2nikhiljdsd';
            }
            $salt = createSalt();
            $pass = hash('sha256', $salt . $passw);
            $sql = "INSERT INTO `tbl_admin_user` (`profile_photo`, `firstname`, `lastname`, `contact`, `username`, `password`,`security_question`,`security_answer`, `gender`, `employee_number`, `address`) VALUES ('$profilePhoto', '$fname', '$lname', '$contact', '$username', '$pass', '$security_question', '$security_answer', '$gender', '$employee_number', '$address')";
            if ($qsql = mysqli_query($conn, $sql)) {
                // Display success message
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
            } else {
                echo mysqli_error($conn);
            }
        }
    }
}

if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM tbl_admin_user WHERE userid='$_GET[editid]' ";
    $qsql = mysqli_query($conn, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}

?>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">

<div class="page-wrapper">
<h2>Add Clinic Coordinator</h2>
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">

<!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="page-header-breadcrumb">

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
    
    <h5>Personal Details</h5>
        <hr>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-4">
                <input class="form-control" type="date" name="date" max="<?php echo date("Y-m-d"); ?>"
                            id="date" value="<?php echo $rsedit['date']; ?>" />
            </div>
        </div>

        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Profile Photo</label>
                        <div class="col-sm-4">
                            <input type="file" id="photo-upload" accept="image/*" class="form-control" name="profile_photo" id="profile_photo" placeholder="" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['profile_photo']; } ?>" >
                        </div>
                    
                    <label class="col-sm-2 col-form-label">Employee Number</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="employee_number" id="employee_number" 
                value="<?php if(isset($_GET['editid'])) { echo $rsedit['employee_number']; } ?>" />
            </div>           
        </div>

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
    </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <textarea name="address" id="address" class="form-control"><?php if(isset($_GET['editid'])) { echo $rsedit['address']; } ?></textarea>
        </div>
    
    </div>
    <h5>Security Details</h5>
    <hr>
    <div class="form-group row">
            <?php 
        if(!isset($_GET['editid']))
        {
        ?>
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="username" id="username"
                                value="<?php if(isset($_GET['editid'])) { echo $rsedit['username']; } ?>" />
                    <span class="messages"></span>
                </div>
        </div>
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

    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Security Question</label>
                <div class="col-sm-4">
                    <select name="security_question" id="security_question" class="form-control" required="">
                        <option value="">-- Select One -- </option>
                        <option value="Male" <?php if(isset($_GET['editid']))
                            { if($rsedit['security_question'] == 'Male') { echo 'selected'; } } ?>>Male</option>
                        <option value="Female" <?php if(isset($_GET['editid']))
                            { if($rsedit['security_question'] == 'Female') { echo 'selected'; } } ?>>Female</option>
                    </select>
                </div>
            <label class="col-sm-2 col-form-label">Security Answer</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="security_answer" id="security_answer" 
                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['security_answer']; } ?>" />
                </div>
        </div>                 
<?php } ?>

    
    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary m-b-0">Submit</button>
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