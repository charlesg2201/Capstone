<title>Patient</title>
<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
$qsqlpatient = mysqli_query($conn, $sqlpatient);
$patient = mysqli_fetch_array($qsqlpatient);
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sub-title">
                            <h2>Welcome <?php echo '' . $_SESSION['firstname']; ?>!</h2>
                        </div>
                        <ul class="nav nav-tabs md-tabs b-none" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="studentdetails.php" role="tab">My Details</a>
                                <div class="slide"></div>
                            </li>
                        </ul>

                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <p class="m-0">
                                    <table class="table table-hover">
                       <tr>
                          <th>LRN Number :</th>
                          <td>&nbsp;<?php echo $patient['lrn_number']; ?></td>
                        </tr>
                        <tr>
                          <th>Username :</th>
                          <td>&nbsp;<?php echo $patient['studentid']; ?></td>
                        </tr>
                        <tr>
                          <th>First Name :</th>
                          <td>&nbsp;<?php echo $patient['fname']; ?></td>
                              </tr>
                              <tr>
                          <th>Last Name :</th>
                          <td>&nbsp;<?php echo $patient['lname']; ?></td>
                              </tr>
                              <tr>
                          <th>Guardian Name :</th>
                          <td>&nbsp;<?php echo $patient['guardian_name']; ?></td>
                              </tr>
                              <tr>
                          <th>Guardian's Contact Number :</th>
                          <td>&nbsp;<?php echo $patient['contact']; ?></td>
                        </tr>
                        <tr>
                          <th>Address :</th>
                          <td>&nbsp;<?php echo $patient['address']; ?></td>
                          </tr>
                        <tr>
                          <th>Gender :</th>
                          <td>&nbsp;<?php echo $patient['gender'];?></td>
                          </tr>
                           <tr>
                          <th>Date Of Birth : </th>
                          <td>&nbsp;<?php echo $patient['dob']; ?></td>
                        </tr>
                                    </table>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
