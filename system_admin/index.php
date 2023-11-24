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
                <!--    
                    <?php if ($_SESSION['user'] == 'tbl_admin') { ?>
                        
                            <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8s">
                                            <h6 class="text-white m-b-0">Patients Record</h6>
                                            <a class="small text-blue stretched-link" href="view-patient.php">View Record</a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM patient WHERE status='Active' and delete_status='0'";
                                                $qsql = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Total Patients</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    -->
                    <div class="col-xl-3 col-md-6">
                        <div style = "background-color: #3498db">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                        <h5 id="currentDate" class="text-white m-b-0" style="font-size: 1.25rem;"></h5>

<script>
    // Function to format the date as "Month Day, Year"
    function formatDate(date) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    // Get the current date
    const currentDate = new Date();

    // Display the formatted current date in the HTML element with the id "currentDate"
    document.getElementById('currentDate').textContent = ` ${formatDate(currentDate)}`;
</script>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                        <div style = "background-color: #3498db">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                        <p id="currentTime" class="text-white" style="font-size: 1.20rem;"></p>
                    <script>
    // Function to format the time as "Hour:Minute:Second AM/PM"
    function formatTime(time) {
      const options = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
      return time.toLocaleTimeString('en-US', options);
    }

    // Function to update the time every second
    function updateTime() {
      const currentTime = new Date();
      document.getElementById('currentTime').textContent = ` ${formatTime(currentTime)}`;
    }

    // Initial display of time
    updateTime();

    // Update the time every second
    setInterval(updateTime, 1000);
  </script>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                        <div style = "background-color: #3498db">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM tbl_admin_user WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Total Clinic Coordinator</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                        <div style = "background-color: #3498db">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM tbl_admin WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Performing System Administrator</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <iframe src="graph.php" frameborder="0" width="100%" height="450"></iframe>
                        <iframe src="graph2.php" frameborder="0" width="100%" height="450"></iframe>

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
