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
        $q1 = "UPDATE tbl_admin SET `password`='$password', `security_question` = '$security_question', `security_answer` = '$security_answer'WHERE id = '".$_SESSION["id"]."'";

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
        $username = $row['username'];
        $password = $row['password'];
        $security_question = $row['security_question'];
        $security_answer = $row['security_answer'];
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
                                       
    <h5>Security Details</h5>
    <hr>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" name="username" id="username" value="<?php echo $employee_number; ?>" readonly  />
        <span class="messages"></span>
    </div>
</div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
        <input class="form-control" type="password" name="password" id="password" value="<?php echo $password ?>" readonly />
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
        <input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $password ?>" readonly />
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

    function toggleUsernameField() {
        var usernameField = document.getElementById('username');
        
        if (usernameField.hasAttribute('disabled')) {
            // Enable the username field
            usernameField.removeAttribute('disabled');
        } else {
            // Disable the username field
            usernameField.setAttribute('disabled', 'true');
        }
    }

    // Add click event listener to the "Edit" button
    var editButton = document.getElementById('editButton');
    editButton.addEventListener('click', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        
        // Call the function to toggle the disabled attribute on the username field
        toggleUsernameField();
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


