<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<html lang="en">
<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

$sql = "select * from tbl_admin where id = '".$_SESSION["id"]."'";
$result = $conn->query($sql);
$row1 = mysqli_fetch_array($result);

$sql_manage = "select * from manage_website";
$result_manage = $conn->query($sql_manage);
$row_manage = mysqli_fetch_array($result_manage);
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
                <div class="page-body">
                    <div class="row">
                        <?php if ($_SESSION['user'] == 'tbl_admin_user') { ?>
                        
                        <?php } else if ($_SESSION['user'] == 'patient') { ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">My Profile</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="studentdetails.php" style="color: #ffffff; font-size: 12px;">View Profile</a>
                                        <div class="small text-white"><i class="feather icon-user" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Admission Record</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="admissionrecord.php?patientid=<?php echo $_SESSION["patientid"]; ?>" style="color: #ffffff; font-size: 12px;">View</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Physcial Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="physical.php" style="color: #ffffff; font-size: 12px;">Take Assessment</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                    <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Health Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="health.php" style="color: #ffffff; font-size: 12px;">Take Assessment</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>
                        
                    <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Messages</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="messages.php?patientid=<?php echo $_SESSION["patientid"]; ?>" style="color: #ffffff; font-size: 12px;">Inbox</a>
                                        <div class="small text-white"><i class="feather icon-mail" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        </body>
                        </html>
<?php include('footer.php'); ?>

