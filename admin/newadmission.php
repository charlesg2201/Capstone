<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if (isset($_POST['btn_submit'])) {
    if (isset($_GET['editid'])) {
        $lrn_query = mysqli_query($conn, "SELECT lrn_number, fname, lname, mname FROM patient WHERE patientid = '$_GET[editid]'");
        $lrn_data = mysqli_fetch_assoc($lrn_query);
        $lrn_number = $lrn_data['lrn_number'];
        $fname = $lrn_data['fname'];
        $lname = $lrn_data['lname'];
        $mname = $lrn_data['mname'];

        $reason = $_POST['reasons'];
        

        if ($reason == 'Others') {
            // If "Others" is selected, save the custom reason from the input field
            $reason = $_POST['other_reason'];
        }

        $sql = "INSERT INTO tbl_admission (patientid, fname, lname, mname, lrn_number, admission_date, admission_time, reasons, remarks) 
                VALUES ('$_GET[editid]', '$fname', '$lname', '$mname', '$lrn_number', '$_POST[admissiondate]', '$_POST[admissiontime]', '$reason', '$_POST[remarks]')";


        if ($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success
                </h3>
                <p>Admission record added Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'patientreport.php?patientid=$_GET[editid]';\",1500);</script>"; ?>
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
    $sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);

}


?>
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
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>New Admission</h4></div>
                        <div class="card-block">

<div class="card-block">
    <h5>Admission Details</h5>
    <hr>
<form id="main" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Admission Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="admissiondate" id="admissiondate" placeholder="Enter admissiondate...." required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['admissiondate']; } ?>" >
            <span class="messages"></span>
        </div>
        <script>
    var currentDate = new Date().toISOString().split('T')[0];

    // Set the min and max attributes of the date input to the current date
  
    document.getElementById('admissiondate').setAttribute('max', currentDate);
</script>
        <label class="col-sm-2 col-form-label">Admission Time</label>
        <div class="col-sm-4">
            <input type="time" class="form-control" name="admissiontime" id="admissiontime" placeholder="Enter admissiontime...." required="" value="<?php echo $rsedit['admissiontime']; ?>">
            <span class="messages"></span>
        </div>
    </div>
<script>
    // Get the current time
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();

    // Format current time in HH:MM format
    var currentTimeString = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;

    // Set the value of the input field to the current time
    document.getElementById("admissiontime").value = currentTimeString;

    // Function to prevent selection of future hours
    document.getElementById("admissiontime").addEventListener('input', function() {
        var selectedTime = this.value.split(":");
        var selectedHour = parseInt(selectedTime[0]);
        var selectedMinute = parseInt(selectedTime[1]);
        
        if (selectedHour > hours || (selectedHour === hours && selectedMinute > minutes)) {
            // If future time is selected, reset to current time
            this.value = currentTimeString;
        }
    });
</script>


    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Reasons</label>
    <div class="col-sm-4">
        <select class="form-control show-tick" name="reasons" id="reasons" required="">
            <option value="">Select</option>
            <?php
            $arr = array("Fever", "Cough", "Cold", "Sorethroat", "Headache", "Asthma", "Others");
            foreach ($arr as $val) {
                if ($val == $rsedit['reasons']) {
                    echo "<option value='$val' selected>$val</option>";
                } else {
                    echo "<option value='$val'>$val</option>";
                }
            }
            ?>
        </select>
        <span class="messages"></span>
    </div>

   

        <label class="col-sm-2 col-form-label">Remarks</label>
        <div class="col-sm-4">
                <input type="text" class="form-control" name="remarks" id="remarks" required=""  value="" >
                <span class="messages"></span>
        </div>
    </div>
    <div class="form-group row">
    <div class="col-sm-6" style="padding-left: 283px">
        <input type="text" class="form-control" name="other_reason" id="other_reason" placeholder="Enter Other Reason" style="display: none;">
    </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>

</form>

<script>
    document.getElementById('reasons').addEventListener('change', function() {
        var otherReasonInput = document.getElementById('other_reason');
        if (this.value === 'Others') {
            otherReasonInput.style.display = 'block';
            otherReasonInput.required = true; // Make the other reason input field required
        } else {
            otherReasonInput.style.display = 'none';
            otherReasonInput.required = false; // Remove the required attribute if "Others" is not selected
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
</div>
</div>

<?php include('footer.php');?>


