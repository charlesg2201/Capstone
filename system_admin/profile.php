<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_POST["btn_update"])) { // Change this condition to check for the "Update" button
    extract($_POST);

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'profile_photos/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uploadedFileName = $uploadDir . uniqid() . '_' . $_FILES['profile_photo']['name'];

        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadedFileName)) {
            $profilePhoto = mysqli_real_escape_string($conn, $uploadedFileName);

            $q1 = "UPDATE tbl_admin SET `profile_photo`='$profilePhoto' WHERE id = '".$_SESSION["id"]."'";
            if ($conn->query($q1) !== TRUE) {
                echo "Failed to update the profile photo in the database.";
                exit;
            }
        } else {
            echo "Failed to upload the profile photo.";
            exit;
        }
    }

    if($_SESSION['user'] == 'tbl_admin'){
        $q1 = "UPDATE tbl_admin SET `employee_number`='$employee_number', `firstname`='$firstname', `username`='$username', `contact`='$contact', `password`='$password' WHERE id = '".$_SESSION["id"]."'";

    }

    if ($conn->query($q1) === TRUE) {
        $_SESSION['success'] = 'Record Successfully Updated';
    } else {
        $_SESSION['error'] = 'Something Went Wrong';
    }
}
?>

<?php
if($_SESSION['user'] == 'tbl_admin'){
    $que = "select * from  tbl_admin where id = '".$_SESSION["id"]."'";
    $query = $conn->query($que);
    while($row = mysqli_fetch_array($query)) {
        extract($row);
        $firstname = $row['firstname'];
        $username = $row['username'];
        $contact = $row['contact'];
        $employee_number = $row['employee_number'];
        $addr = $row['addr'];
        $profilePhoto = $row['profile_photo'];
    }
}
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-block">
                                    <form id="main" method="post" enctype="multipart/form-data">
                                        <div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; margin-top: -30px; margin-right: 10px;">
                                            <img class="profile-img" src="<?php echo $profilePhoto ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Profile Image">
                                        </div>
                                        <div class="form-group row"></div>
                                        <br>
                                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Profile Photo</label>
                        <div class="col-sm-4">
                            <input type="file" id="profile_photo" accept="image/*" class="form-control" name="profile_photo" id="profile_photo" placeholder=""   value="<?php if(isset($_GET['editid'])) { echo $rsedit['profile_photo']; } ?>" readonly >
                        </div>
                    
                    <label class="col-sm-2 col-form-label">Employee Number</label>
            <div class="col-sm-4">
            <input class="form-control" type="text" name="employee_number" id="employee_number" 
    value="<?php echo $employee_number; ?>" 
    oninput="validateEmployeeNumber()" required readonly />
        <span class="messages"></span>
    </div>
    <script>
    function validateEmployeeNumber() {
        var contactField = document.getElementById("employee_number");
        var contactValue = contactField.value;

        // Use a regular expression to check for only numbers
        var regex = /^[0-9]+$/;

        if (!regex.test(contactValue)) {
            alert("Please enter a valid employee_number.");
            contactField.value = "";
        } 
        
    }
</script>
        </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" required="" value="<?php echo $firstname; ?>" readonly>
            <span class="messages"></span>
        </div>
        

        <label class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" name="lname" id="lname" placeholder="" required="" value="<?php echo $lname; ?>" readonly>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Contact Number</label>
    <div class="col-sm-4">
    <input class="form-control" type="text" name="contact" id="contact" value="<?php echo $contact; ?>" oninput="validateContactNumber()" required readonly />
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
        } else if (contactValue.length > 11) {
            alert("Maximum length of contact number is 11 digits.");
            contactField.value = contactValue.substring(0, 11); // Truncate to 11 digits
        }
    }
</script>
<label class="col-sm-2 col-form-label">Gender</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" name="gender" id="gender" placeholder="" value="<?php echo $gender; ?>" readonly>
            <span class="messages"></span>
        </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
        <textarea name="addr" id="addr" class="form-control" readonly><?php echo $addr; ?></textarea>
        </div>
    
    </div>
    <h5>Security Details</h5>
    <hr>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-4">
        <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" readonly />
            <span class="messages"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
        <input class="form-control" type="password" name="password" id="password" value="********" readonly />
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
        <input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="********" readonly />
            <span class="messages" id="confirm-pw" style="color: red;"></span>
        </div>
    </div>

    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Security Question</label>
                <div class="col-sm-4">
                <input class="form-control" type="text" name="security_question" id="security_question" value="<?php echo $security_question; ?>" readonly />
            <span class="messages"></span>
    
                </div>
            <label class="col-sm-2 col-form-label">Security Answer</label>
                <div class="col-sm-4">
                <input class="form-control" type="text" name="security_answer" id="security_answer" value="<?php echo $security_answer; ?>" readonly />
                </div>
        </div> 
<?php  ?>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
                                           <!-- Edit Button -->
<button type="button" name="btn_edit" id="editButton" class="btn btn-primary m-b-0">Edit</button>

<!-- Update Button (Initially hidden) -->
<button type="submit" name="btn_update" id="updateButton" class="btn btn-success m-b-0" style="display: none;">Update</button>

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
                                            <?php echo "<script>setTimeout(\"location.href = 'profile.php';\",1500);</script>"; ?>
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
                            <script>
   document.addEventListener("DOMContentLoaded", function() {
    // Function to remove readonly attribute from input fields
    function makeFieldsEditable() {
        var inputFields = document.querySelectorAll('input[readonly], textarea[readonly]');
        inputFields.forEach(function(field) {
            field.removeAttribute('readonly');
        });

        // Show the "Update" button and hide the "Edit" button
        document.getElementById('updateButton').style.display = 'block';
        document.getElementById('editButton').style.display = 'none';
    }

    // Add click event listener to the "Edit" button
    var editButton = document.getElementById('editButton');
    editButton.addEventListener('click', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        
        // Call the function to make fields editable
        makeFieldsEditable();
    });
});

</script>

<script type="text/javascript">
    $('#main').keyup(function () {
        $('#confirm-pw').html('');
    });

    $('#cnfirmpassword').change(function () {
        if ($('#cnfirmpassword').val() != $('#password').val()) {
            $('#confirm-pw').html('Password Not Match');
        }
    });

    $('#password').change(function () {
        if ($('#cnfirmpassword').val() != $('#password').val()) {
            $('#confirm-pw').html('Password Not Match');
        }
    });
</script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


