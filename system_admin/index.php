<!DOCTYPE html>
<title>System Admin</title>
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
            <div class="page-wrapper full-calender">
                <div class="page-body">
                    <div class="row">
                        <?php if ($_SESSION['user'] == 'tbl_admin') { ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">
                                                <?php
                                                $sql = "SELECT * FROM tbl_admin_user WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($qsql);
                                                ?></div>
                                        <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" style="color: #ffffff; font-size: 15px;">Total Clinic Coordinator</a>
                                        <div class="small text-white"><i class="feather icon-users" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">

                                            <?php
                                                $sql = "SELECT * FROM tbl_admin WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($qsql);
                                                ?></div>
                                        
                                        <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" style="color: #ffffff; font-size: 15px;">Performing System Admin</a>
                                        <div class="small text-white"><i class="feather icon-users" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                        
                        <!-- <iframe src="graph.php" frameborder="0" width="100%" height="450"></iframe>
                        <iframe src="graph2.php" frameborder="0" width="100%" height="450"></iframe> -->

                        <?php } else if ($_SESSION['user'] == 'patient') {

                        $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
                        $qsqlpatient = mysqli_query($conn, $sqlpatient);
                        $rspatient = mysqli_fetch_array($qsqlpatient);
                        ?>
                        <div class="row col-lg-12">
                            <h3><b>Dashboard</b></h3>
                        </div>

                        <div class="card row col-lg-12">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="sub-title">
                                            <h2>Welcome <?php echo '' . $_SESSION['firstname']; ?>!</h2>
                                        </div>
                                        <ul class="nav nav-tabs md-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Admission Record</a>
                                                <div class="slide"></div>
                                            </li>
                                        </ul>

                                        <div class="tab-content card-block">
                                            <div class="tab-pane active" id="home3" role="tabpanel">
                                                <p class="m-0">
                                                    <h3>You are with us from <?php echo $rspatient['admissiondate']; ?> <br>
                                                        <?php echo $rspatient['admissiontime']; ?></h3>
                                                </p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
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

<?php include('footer.php'); ?>
