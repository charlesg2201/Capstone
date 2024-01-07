<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_POST["btn_update"])) {
    extract($_POST);

    // Check if the password field is empty or contains only spaces
    if(empty($password) || trim($password) === "") {
        $_SESSION['error'] = 'Password cannot be blank.';
    } elseif ($password !== trim($password)) {
        $_SESSION['error'] = 'Password should not start or end with spaces.';
    } else {
        // Continue with the update logic if the password is not blank and doesn't start or end with spaces

        if($_SESSION['user'] == 'tbl_admin') {
            $q1 = "UPDATE tbl_admin SET `password`='$password' WHERE id = '".$_SESSION["id"]."'";

            if ($conn->query($q1) === TRUE) {
                $_SESSION['success'] = 'Record Successfully Updated';
            } else {
                $_SESSION['error'] = 'Something Went Wrong';
            }
        }
    }
}
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-##############" crossorigin="anonymous" />

<style>
      .box-header {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px; /* Set your desired height */
        background-color: #0a4b78;
        color: white;
        font-weight: bold;
        }

        .box-header h4 {
        margin: 0;
        }                  

        .toggle-password {
        cursor: pointer;
        font-size: 20px; /* Adjust the font size */
        position: absolute; /* Use absolute positioning */
        margin-top: 10px;
        margin-left: 3px;
        }

</style>
</head>
<?php
if($_SESSION['user'] == 'tbl_admin'){
    $que = "select * from  tbl_admin where id = '".$_SESSION["id"]."'";
    $query = $conn->query($que);
    while($row = mysqli_fetch_array($query)) {
        extract($row);
        $username = $row['username'];
        $password = $row['password'];
    }
}
?>

<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Security Details</h4></div>
                        <div class="card-block">
                                    <form id="main" method="post" enctype="multipart/form-data">
                                        <br>
                                        <br>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-3">
        <input class="form-control" type="text" name="username" id="username" value="<?php echo $employee_number; ?>" readonly  />
        <span class="messages"></span>
    </div>
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-3">
        <div class="input-group">
        <input class="form-control" type="password" name="password" id="password" value="<?php echo $password ?>" readonly/>
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="toggle-password fas fa-eye" onclick="togglePasswordVisibility()"></i>
            </span>
        </div>
    </div>
    <span class="messages"></span>
        </div>

        
    </div>

    
<?php  ?>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
<button type="button" name="btn_edit" id="editButton" class="btn btn-primary m-b-0">Edit</button>

<button type="submit" name="btn_update" id="updateButton" class="btn btn-success m-b-0" style="display: none;">Update</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php include('footer.php'); ?>
                            <link rel="stylesheet" href="popup_style.css">
                            <script>
                                function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    var icon = document.querySelector('.toggle-password');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

                            </script>
                             <?php if(!empty($_SESSION['success'])) {  ?>
                                <div class="popup popup--icon -success js_success-popup popup--visible">
                                    <div class="popup__background"></div>
                                    <div class="popup__content">
                                        <h3 class="popup__content__title">
                                            Success
                                        </h3>
                                        <p><?php echo $_SESSION['success']; ?></p>
                                        <p>
                                            <?php echo "<script>setTimeout(\"location.href = 'changepassword.php';\",1500);</script>"; ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


