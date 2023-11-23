<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_POST["btn_update"])) {
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
        $q1 = "UPDATE tbl_admin SET `employee_number`='$employee_number', `firstname`='$firstname', `username`='$username', `contact`='$contact' WHERE id = '".$_SESSION["id"]."'";
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
                                                <input type="file" id="photo-upload" accept="image/*" class="form-control" name="profile_photo" id="profile_photo" placeholder=""   value="<?php if(isset($_GET['editid'])) { echo $rsedit['profile_photo']; } ?>" >
                                            </div>

                                            <label class="col-sm-2 col-form-label">Employee Number</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="employee_number" name="employee_number" value="<?php echo $employee_number; ?>" placeholder="">
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $firstname; ?>"  placeholder="">
                                                <span class="messages"></span>
                                            </div>

                                            <label class="col-sm-2 col-form-label">Contact</label>
                                            <div class="col-sm-4">
                                                <input type="tel" class="form-control" id="contact" name="contact" value="<?php echo $contact;?>" placeholder="" minlength="11" maxlength="11" pattern="^[0][1-9]\d{9}$|^[1-9]\d{9}$">
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-4">
                                                <input type="email" class="form-control" id="username" name="username" value="<?php echo $username; ?>" placeholder="">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
