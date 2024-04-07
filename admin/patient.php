<!DOCTYPE html>
<html lang="en">

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
</style>
<?php require_once('check_login.php');?>
    <?php include('head.php');?>
    <?php include('header.php');?>
    <?php include('sidebar.php');?>
    <?php include('connect.php');
    if(isset($_POST['btn_submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $lrn_number = $_POST['lrn_number'];
        $contact = $_POST['contact'];
        $strand = $_POST['strand'];
        $grade_level = $_POST['grade_level'];
        $section = $_POST['section'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $dob= $_POST['dateofbirth'];
        // $security_question = $_POST['security_question'];
        // $security_answer = $_POST['security_answer'];
        //$password = substr($_POST['lname'], 0, 2) . mt_rand(111111, 999999);
        $date = date("Y-m-d");
        // Generate student ID
        $studentid = $lrn_number;

        // Use the date of birth as the password
        $password = date("mdY", strtotime($dob));
        $academic_year = $_POST['academic_year'];


        // $studentid = "";
        // $strs = explode(" ", $_POST['fname']);
        // foreach ($strs as $str) {
        //     $studentid .= $str[0];
        // }
    
        // $fullname = $studentid . str_replace(' ', '', $_POST['lname']);
        // $studentid = strtolower(mysqli_real_escape_string($conn, $fullname));

        if(isset($_GET['editid']))
            {
                $sql ="UPDATE patient SET lrn_number='$_POST[lrn_number]',fname='$_POST[fname]',lname='$_POST[lname]',mname='$_POST[mname]',contact_number='$_POST[contact_number]',email='$_POST[email]',strand='$_POST[strand]',guardian_name='$_POST[guardian_name]',address='$_POST[address]',contact='$_POST[contact]',gender='$_POST[gender]',dob='$_POST[dateofbirth]',grade_level='$_POST[grade_level]',section='$_POST[section]',academic_year='$_POST[academic_year]' WHERE patientid='$_GET[editid]'";
                if($qsql = mysqli_query($conn,$sql))
                {
        ?>
                    <div class="popup popup--icon -success js_success-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">
                        Success
                        </h3>
                        <p>Patient Record Updated Successfully</p>
                        <p>
                        <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                        <?php echo "<script>setTimeout(\"location.href = 'view-patient.php';\",1500);</script>"; ?>
                        </p>
                    </div>
                    </div>
        <?php
                }
            }else{
                
        $checkDuplicateQuery = "SELECT COUNT(*) FROM patient WHERE lrn_number = '$lrn_number'";
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
                    <a href="patient.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
                    </p>
                </div>
                </div>
            <?php
        }else{
                $sql = "INSERT INTO patient(date,fname,lname,mname,lrn_number,contact_number,email,grade_level,strand,section,guardian_name,address,contact,studentid,password,gender,dob,academic_year) values('$date','$_POST[fname]','$_POST[lname]','$_POST[mname]','$_POST[lrn_number]','$_POST[contact_number]','$_POST[email]','$_POST[grade_level]','$_POST[strand]','$_POST[section]','$_POST[guardian_name]','$_POST[address]','$_POST[contact]','$studentid','$password','$_POST[gender]','$_POST[dateofbirth]','$_POST[academic_year]')";

                if($qsql = mysqli_query($conn,$sql))
                {
        ?>
                    <div class="popup popup--icon -success js_success-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">
                        Success
                        </h3>
                        <p>Patient Record Inserted Successfully</p>
                        <p>
                        <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                        <?php echo "<script>setTimeout(\"location.href = 'view-patient.php';\",1500);</script>"; ?>
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

            }

     
    if(isset($_GET['editid']))
    {
        $sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
        $qsql = mysqli_query($conn,$sql);
        $rsedit = mysqli_fetch_array($qsql);

    }

    ?>
	
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Student Details</h4></div>
                        <div class="card-block">
                        <form id="main" method="post" action="" enctype="multipart/form-data">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
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
<hr>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> LRN Number </label>


            <div class="col-sm-4">
                <input class="form-control" type="text" name="lrn_number" id="lrn_number" 
                value="<?php if(isset($_GET['editid'])) { echo $rsedit['lrn_number']; } ?>"  oninput="validatelrnNumber()" required />
                <span class="messages"></span>
            </div>
            <script>
    function validatelrnNumber() {
        var contactField = document.getElementById("lrn_number");
        var contactValue = contactField.value;

        // Use a regular expression to check for only numbers
        var regex = /^[0-9]+$/;

        if (!regex.test(contactValue)) {
            alert("Please enter a valid lrn_number.");
            contactField.value = "";
        } 
        
    }
</script>
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> First Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['fname']; } ?>" >
                <span class="messages"></span>
            </div>

            
        </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Middle Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="mname" id="mname" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['lname']; } ?>" >
                <span class="messages"></span>
            </div>
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Last Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="lname" id="lname" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['lname']; } ?>" >
                <span class="messages"></span>
            </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Contact Number</label>
        <div class="col-sm-4">
        <input class="form-control" type="text" name="contact_number" id="contact_number"
    value="<?php if(isset($_GET['editid'])) { echo $rsedit['contact_number']; } ?>"
    oninput="validateContact_Number()" required />
<span class="messages"></span>
                </div>
                <script>
    function validateContact_Number() {
        var contactField = document.getElementById("contact_number");
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
                        

            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Active Email Address</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" id="email" required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['email']; } ?>" >
                <span class="messages"></span>
            </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Strand</label>
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
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Grade Level</label>
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
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Section</label>
            <div class="col-sm-4">
                <select name="section" id="section" class="form-control" required="">
                    <option value="">-- Select One -- </option>
                    <?php
                    // Fetch strands from the database
                    $sqlSections = "SELECT * FROM tbl_section WHERE delete_status='0'";
                    $resultSections = mysqli_query($conn, $sqlSections);

                    while ($rowSection = mysqli_fetch_assoc($resultSections)) {
                        $selected = (isset($_GET['editid']) && $rsedit['section'] == $rowSection['sections']) ? 'selected' : '';
                        echo "<option value='{$rowSection['sections']}' $selected>{$rowSection['sections']}</option>";
                    }
                    ?>
                </select>
            </div>
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Gender</label>
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
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Date of Birth</label>
            <div class="col-sm-4">
                <input class="form-control" type="date" name="dateofbirth" max="<?php echo date("m-d-Y"); ?>"
                            id="dateofbirth" value="<?php echo $rsedit['dob']; ?>" required />
            </div>
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Address</label>
                <div class="col-sm-4">
                    <textarea name="address" id="address" class="form-control" required=""><?php if(isset($_GET['editid'])) { echo $rsedit['address']; } ?></textarea>
                </div>
</div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Guardian</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="guardian_name" id="guardian_name"
                                value="<?php if(isset($_GET['editid'])){ echo $rsedit['guardian_name']; } ?>" required />
                    <span class="messages"></span>
                </div>

            <label class="col-sm-2 col-form-label"><span style="color: red;"> *</span> Guardian's Contact Number</label>
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
        } else if (contactValue.length > 11) {
            alert("Maximum length of contact number is 11 digits.");
            contactField.value = contactValue.substring(0, 11); // Truncate to 11 digits
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
</html>
    <?php include('footer.php');?>
