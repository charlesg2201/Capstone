<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if (isset($_POST['btn_submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $lrn_number = $_POST['lrn_number'];
    $contact = $_POST['contact'];  // Added the missing field
    $strand = $_POST['strand'];
    $grade_level = $_POST['grade_level'];
    $section = $_POST['section'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $dob = $_POST['dateofbirth'];
    $date = date("Y-m-d");
    $studentid = strtolower($fname . $lname);
    $password = date("mdY", strtotime($dob));

    if (!isset($_GET['editid'])) {
        $checkDuplicateQuery = "SELECT COUNT(*) FROM patient WHERE lrn_number = '$lrn_number'";
        $result = mysqli_query($conn, $checkDuplicateQuery);
        $row = mysqli_fetch_row($result);
        $count = $row[0];

        if ($count > 0) {
            ?>
            <div class="popup popup--icon -error js_error-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                    <h3 class="popup__content__title">Error</h3>
                    <p>The details you are trying to add already exist.</p>
                    <p>
                        <a href="patient.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
                    </p>
                </div>
            </div>
            <?php
        } else {
            $sql = "INSERT INTO patient(date,fname,lname,mname,lrn_number,contact_number,email,academic_year,grade_level,strand,section,guardian_name,address,contact,studentid,password,gender,dob) values('$date','$fname','$lname','$mname','$lrn_number','$contact','$_POST[email]','$_POST[academic_year]','$grade_level','$strand','$section','$_POST[guardian_name]','$address','$contact','$studentid','$password','$gender','$dob')";
            if ($qsql = mysqli_query($conn, $sql)) {
                ?>
                <div class="popup popup--icon -success js_success-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">Success</h3>
                        <p>Patient Record Inserted Successfully</p>
                        <p>
                            <?php echo "<script>setTimeout(\"location.href = 'view-patient.php';\",1500);</script>"; ?>
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
    $sql = "SELECT * FROM patient WHERE patientid='$_GET[editid]'";
    $qsql = mysqli_query($conn, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header"><legend>Student Details</legend></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
    


        <hr>
    <form id="main" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
            <label class="col-sm-2"></label>
            <div class="col-sm-4">

                <span class="messages"></span>
            </div>

            <label class="col-sm-2 col-form-label">Academic Year</label>
<div class="col-sm-4">
    <select name="academic_year" id="academic_year" class="form-control" required="">
        <?php
        // Fetch academic years from the database
        $sqlAcademicYears = "SELECT * FROM tbl_academicyear WHERE delete_status='0'";
        $resultAcademicYears = mysqli_query($conn, $sqlAcademicYears);

        while ($rowAcademicYear = mysqli_fetch_assoc($resultAcademicYears)) {
            $selected = (isset($_GET['editid']) && $rsedit['academic_year'] == $rowAcademicYear['academic_year']) ? 'selected' : '';
            echo "<option value='{$rowAcademicYear['academic_year']}' $selected>{$rowAcademicYear['academic_year']}</option>";
        }
        ?>
    </select>

   
</div>


        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['fname']; } ?>" >
                <span class="messages"></span>
            </div>

            <label class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="lname" id="lname" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['lname']; } ?>" >
                <span class="messages"></span>
            </div>
        </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Middle Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="mname" id="mname" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['lname']; } ?>" >
                <span class="messages"></span>
            </div>
            <label class="col-sm-2 col-form-label">LRN Number</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="lrn_number" id="lrn_number" 
                value="<?php if(isset($_GET['editid'])) { echo $rsedit['lrn_number']; } ?>" />
            </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Contact Number</label>
        <div class="col-sm-4">
                    <input class="form-control" type="text" name="contact_number" id="contact"
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

            <label class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" id="email" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['email']; } ?>" >
                <span class="messages"></span>
            </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Strand</label>
            <div class="col-sm-4">
                <select name="strand" id="strand" class="form-control" required="">
                    <option value="">-- Select One -- </option>
                    <?php
                    // Fetch strands from the database
                    $sqlStrands = "SELECT * FROM tbl_strands WHERE delete_status='0'";
                    $resultStrands = mysqli_query($conn, $sqlStrands);

                    while ($rowStrand = mysqli_fetch_assoc($resultStrands)) {
                        $selected = (isset($_GET['editid']) && $rsedit['strand'] == $rowStrand['strands']) ? 'selected' : '';
                        echo "<option value='{$rowStrand['strands']}' $selected>{$rowStrand['strands']}</option>";
                    }
                    ?>
                </select>
            </div>
            <label class="col-sm-2 col-form-label">Grade Level</label>
            <div class="col-sm-4">
                <select name="grade_level" id="grade_level" class="form-control" required="">
                    <option value="">-- Select One -- </option>
                    <option value="GRADE 11" <?php if(isset($_GET['editid']))
                        { if($rsedit['grade_level'] == 'GRADE 11') { echo 'selected'; } } ?>>GRADE 11</option>
                    <option value="GRADE 12" <?php if(isset($_GET['editid']))
                        { if($rsedit['grade_level'] == 'GRADE 12') { echo 'selected'; } } ?>>GRADE 12</option>
                </select>
            </div>
</div>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Section</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="section" id="section" 
                value="<?php if(isset($_GET['editid'])) { echo $rsedit['section']; } ?>" />
            </div>
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
            <label class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-4">
                <input class="form-control" type="date" name="dateofbirth" max="<?php echo date("m-d-Y"); ?>"
                            id="dateofbirth" value="<?php echo $rsedit['dob']; ?>" />
            </div>
            <label class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-4">
                    <textarea name="address" id="address" class="form-control"><?php if(isset($_GET['editid'])) { echo $rsedit['address']; } ?></textarea>
                </div>
</div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Guardian</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="guardian_name" id="guardian_name"
                                value="<?php if(isset($_GET['editid'])){ echo $rsedit['guardian_name']; } ?>" />
                    <span class="messages"></span>
                </div>

            <label class="col-sm-2 col-form-label">Guardian's Contact Number</label>
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
        </div>
       
        <!-- <h5>Security Details</h5>
        <hr>
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
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Security Answer</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="security_answer" id="security_answer" 
                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['security_answer']; } ?>" />
                </div>
        </div>                           -->



       
        
    <?php
     ?>

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
