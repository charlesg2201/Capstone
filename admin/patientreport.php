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
<div class="">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-10">
<div class="page-header-title">
<div class="d-inline">

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">

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

            <?php if(($_SESSION['user'] == 'tbl_admin') || ($_SESSION['user'] == 'tbl_admin_user')){ ?>

              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Patient Profile</a>
                  <div class="slide"></div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#security" role="tab">Security Details</a>
                  <div class=""></div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#appointment" role="tab">Admission Record</a>
                  <div class="slide"></div>
              </li>
            
      

              <?php } ?>

              <?php if($_SESSION['user'] == 'tbl_admin') { ?>

                

              <?php } ?>

          </ul>
          <!-- Tab panes -->

          <div class="tab-content card-block">
              <div class="tab-pane active col-5" id="profile" role="tabpanel">
                  <p class="m-0">
                  <?php
                    $sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
                    $qsqlpatient = mysqli_query($conn,$sqlpatient);
                    $rspatient=mysqli_fetch_array($qsqlpatient);
                  ?>

                  <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-hover">
                      <tbody>
                      <tr>
                          <th>LRN Number :</th>
                          <td>&nbsp;<?php echo $rspatient['lrn_number']; ?></td>
                              </tr>
                          <th>First Name :</th>
                          <td>&nbsp;<?php echo $rspatient['fname']; ?></td>
                              </tr>
                              <tr>
                          <th>Last Name :</th>
                          <td>&nbsp;<?php echo $rspatient['lname']; ?></td>
                              </tr>
                              <tr>
                          <th>Strand :</th>
                          <td>&nbsp;<?php echo $rspatient['strand']; ?></td>
                              </tr>
                              <tr>
                          <th>Grade Level :</th>
                          <td>&nbsp;<?php echo $rspatient['grade_level']; ?></td>
                              </tr>
                              <tr>
                          <th>Section :</th>
                          <td>&nbsp;<?php echo $rspatient['section']; ?></td>
                              </tr>
                              <tr>
                          <th>Guardian Name :</th>
                          <td>&nbsp;<?php echo $rspatient['guardian_name']; ?></td>
                              </tr>
                              <tr>
                          <th>Guardian's Contact Number :</th>
                          <td>&nbsp;<?php echo $rspatient['contact']; ?></td>
                        </tr>
                        <tr>
                          <th>Address :</th>
                          <td>&nbsp;<?php echo $rspatient['address']; ?></td>
                          </tr>
                        <tr>
                          <th>Gender :</th>
                          <td>&nbsp;<?php echo $rspatient['gender']; ?></td>
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

              <div class="tab-pane col-4" id="security" role="tabpanel">
                  <p class="m-0">
                  <?php
                    $sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
                    $qsqlpatient = mysqli_query($conn,$sqlpatient);
                    $rspatient=mysqli_fetch_array($qsqlpatient);
                  ?>

                  <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-hover">
                      <tbody>
                      <tr>
                          <th>Username :</th>
                          <td>&nbsp;<?php echo $rspatient['studentid']; ?></td>
                      </tr>
                      <tr>
                          <th>Password :</th>
                          <td>&nbsp;<?php echo $rspatient['password']; ?></td>
                      </tr>
                      <tr>
                          <th>Security Question :</th>
                          <td>&nbsp;<?php echo $rspatient['security_question']; ?></td>
                      </tr>
                      <tr>
                          <th>Security Answer :</th>
                          <td>&nbsp;<?php echo $rspatient['security_answer']; ?></td>
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
                      <thead>
                        <tr>
                          <th>Admission Date</th>
                          <th>Admission Time</th>
                          <th>Reason</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = "SELECT * FROM tbl_admission where patientid='$_GET[patientid]'";
                          $qsql = mysqli_query($conn, $sql);
                          while($rs = mysqli_fetch_array($qsql))
                          {
                            echo "<tr>
                              <td>$rs[admission_date]</td>
                              <td>$rs[admission_time]</td>
                              <td>$rs[reasons]</td>
                              <td>$rs[remarks]</td></tr>";
                          }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                        </tr>
                      </tfoot>
                    </table>
                    <?php
                      if(isset($_SESSION['userid']))
                          {
                            echo "<a href='newadmission.php?editid=$_GET[patientid]' class='btn btn-primary'>Add New Admission</a>";
                          }
                    ?>
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

