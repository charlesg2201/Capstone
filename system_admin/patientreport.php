<?php date_default_timezone_set("Asia/Manila"); ?>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btnsubmit']))

?>
    
<?php
if(isset($_GET['id']))
{ ?>

<?php } ?>
<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Patient Report</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Patient Report</a>
</li>
<li class="breadcrumb-item"><a href="#">Report</a>
</li>
</ul>
</div>
</div>
</div>
</div>


<!-- <h5>DOM/Jquery</h5>
<span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
</div>
<div class="card-block">
  <div class="row">
      <div class="col-lg-12">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs md-tabs b-none" role="tablist">

            <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'users')){ ?>

              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Patient Profile</a>
                  <div class="slide"></div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#appointment" role="tab">Admission Record</a>
                  <div class="slide"></div>
              </li>
            
      

              <?php } ?>

              <?php if($_SESSION['user'] == 'admin') { ?>

                

              <?php } ?>

          </ul>
          <!-- Tab panes -->
          <div class="tab-content tabs-left-content card-block">
              <div class="tab-pane active" id="profile" role="tabpanel">
                  <p class="m-0">
              <?php
                $sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
                $qsqlpatient = mysqli_query($conn,$sqlpatient);
                $rspatient=mysqli_fetch_array($qsqlpatient);
              ?>

                  <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                      <tbody>
                      <tr>
                          <th>Student ID :</th>
                          <td>&nbsp;<?php echo $rspatient['studentid']; ?></td>
                        </tr>
                        <tr>
                          <th>First Name :</th>
                          <td>&nbsp;<?php echo $rspatient['fname']; ?></td>
                              </tr>
                              <tr>
                          <th>Last Name :</th>
                          <td>&nbsp;<?php echo $rspatient['lname']; ?></td>
                              </tr>
                              <tr>
                          <th>Guardian Name :</th>
                          <td>&nbsp;<?php echo $rspatient['guardian_name']; ?></td>
                              </tr>
                              <tr>
                          <th>Contact Number :</th>
                          <td>&nbsp;<?php echo $rspatient['contact']; ?></td>
                        </tr>
                        <tr>
                          <th>Address :</th>
                          <td>&nbsp;<?php echo $rspatient['address']; ?></td>
                          </tr>
                        <tr>
                          <th>Gender :</th>
                          <td> <?php echo $rspatient['gender'];?></td>
                          </tr>
                           <tr>
                          <th>Date Of Birth : </th>
                          <td>&nbsp;<?php echo $rspatient['dob']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  </p>
              </div>
              <div class="tab-pane" id="appointment" role="tabpanel">
                  <p class="m-0">
                    <div class="table-responsive dt-responsive">
                      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <tr>
                          <th>Admission Date :</th>
                          <td>&nbsp;<?php echo date("d-M-Y",strtotime($rspatient['admissiondate'])); ?></td>
                        </tr>
                        <tr>
                          <th>Admission Time :</th>
                          <td>&nbsp;<?php echo date("h:i A",strtotime($rspatient['admissiontime'])); ?></td>
                        </tr>
                    
                      </table>
                    </div>
                  </p>
              </div>

<div id="#">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>

