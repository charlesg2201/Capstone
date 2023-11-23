<!DOCTYPE html>
<title>System Admin</title>
<html lang="en">
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<?php date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

if(isset($_POST["btn_web"]))
{
  extract($_POST);
  if($_FILES['logo']['name']!=''){
      $file_name = $_FILES['logo']['name'];
      $file_type = $_FILES['logo']['type'];
      $file_size = $_FILES['logo']['size'];
      $file_tem_loc = $_FILES['logo']['tmp_name'];
      $file_store = "uploadImage/Logo/".$file_name;

      if (move_uploaded_file($file_tem_loc, $file_store)) {
        echo "file uploaded successfully";
      }
  }
  else{
    $file_name=$_POST['old_image'];
  }
      $folder = "uploadImage/Logo/";

      if (is_dir($folder))
      {
         if ($open = opendir($folder))

          while (($logo=readdir($open)) !=false) {

              if($logo=='.'|| $logo=="..") continue;

              echo '<img src="uploadImage/Logo/'.$logo.'" width="100" height="100">';
          }

          closedir($open);
        }
  //UPDATE `manage_website` SET `id`=[value-1],`business_name`=[value-2],`business_email`=[value-3],`business_web`=[value-4],`portal_addr`=[value-5],`addr`=[value-6],`curr_sym`=[value-7],`curr_position`=[value-8],`front_end_en`=[value-9],`date_format`=[value-10],`def_tax`=[value-11],`logo`=[value-12] WHERE 1
  // $q1="UPDATE `manage_website` SET `business_name`='$business_name',`business_email`='$business_email',`business_web`='$business_web',`portal_addr`='$portal_addr' ,`addr`= '$addr',`curr_sym`= '$curr_sym',`curr_position`='$curr_position',`front_end_en`='$front_end_en' , `date_format` = '$date_format', `def_tax` = '$def_tax', `logo` = '$file_name'";
  if ($conn->query($q1) === TRUE) {

      $_SESSION['success']='Record Successfully Updated';
      ?>
      <script type="text/javascript">
        window.location = "setting.php";
      </script>
      <?php

} else {

      $_SESSION['error']='Something Went Wrong';
}
  ?>
  <script>
  //window.location = "sms_config.php";
  </script>
  <?php
}

?>



<?php
$que="select * from manage_website";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
  //print_r($row);
  extract($row);
  $logo = $row['logo'];
}
?>
 <div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h2>Backup and Restore</h2>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">

</div>
</div>
</div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

        <style>
    .outlined-text {
        display: block;
        background-color: #263238; /* Dark gray background color */
        color: white;
        text-align: left;
        padding: 5px 10px; /* Added left padding */
        margin-left: -10px; /* Added negative margin to compensate for padding */
    }
</style>

<div class="card">
    <div class="card-header">
       
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="border p-3">
                    <h5><span class="outlined-text">Backup</span></h5>
                    <div class="form-group mt-2">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Backup</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="border p-3">
                    <h5><span class="outlined-text">Restore</span></h5>
                    <div class="form-group">
                        <input type="hidden" value="<?=$logo?>" name="old_image">
                        <input type="file" class="form-control mt-2" name="logo">
                        <span class="messages"></span>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>



                    </div>
                </div>
            </div>
        </div>
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
</div>

<div id="#">
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>

