<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="INSERT  into tbl_admission (patientid,admission_date,admission_time,reasons,remarks) values ('$_GET[editid]','$_POST[admissiondate]','$_POST[admissiontime]','$_POST[reasons]','$_POST[remarks]')";
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
<h4>New Admission</h4>

</div>
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
    <h5>Admission Details</h5>
    <hr>
<form id="main" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Admission Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="admissiondate" id="admissiondate" placeholder="Enter admissiondate...." required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['admissiondate']; } ?>" >
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Admission Time</label>
        <div class="col-sm-4">
            <input type="time" class="form-control" name="admissiontime" id="admissiontime" placeholder="Enter admissiontime...." required="" value="<?php echo $rsedit['admissiontime']; ?>">
            <span class="messages"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Reasons</label>
        <div class="col-sm-4">
            <select class="form-control show-tick" name="reasons" id="reasons" required="">
                <option value="">Select</option>
                <?php
            $arr = array("Fever","Cough","Cold","Sorethroat","Headache","Asthma","Others");
            foreach($arr as $val)
            {
                if($val == $rsedit['reasons'])
                {
                    echo "<option value='$val' selected>$val</option>";
                }
                else
                {
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


