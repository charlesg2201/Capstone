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
            <div class="page-wrapper full-calender">
                <div class="page-body">
                    <div class="row">
                        <?php if ($_SESSION['user'] == 'tbl_admin_user') { ?>
                        
                        

                        
                        <?php } else if ($_SESSION['user'] == 'patient') { ?>
                            <div class="col-xl-4 col-md-6">             
                                <div class="card border-primary" style="border-width: 3px; padding: 5px;"> 
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                        <div class="col-8">
                                                <h4 class="text-dark">
                                                <h5 id="currentDate" class="text-dark m-b-0" style="font-size: 1.25rem;"></h5>
                                                </div>
                                            <div class="col-4 text-right">
                                                <span class="pcoded-micon" style="font-size: 3rem;"><i class="feather icon-calendar"></i></span>
                                            <div class="col-4 text-right">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        

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
                        <div class="col-xl-4 col-md-6">             
                                <div class="card border-primary" style="border-width: 3px; padding: 5px;"> 
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                        <div class="col-8">
                                                <h4 class="text-dark">
                             <p id="currentTime" class="text-dark" style="font-size: 1.20rem;"></p>
                                        </div>
                                            <div class="col-4 text-right">
                                                <span class="pcoded-micon" style="font-size: 3rem;"><i class="feather icon-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        
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
                                            <canvas id="update-chart-3" height="60"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        
                          
                  


                        <?php } else if ($_SESSION['user'] == 'tbl_admin_user') {

                        $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
                        $qsqlpatient = mysqli_query($conn, $sqlpatient);
                        $rspatient = mysqli_fetch_array($qsqlpatient);
                        ?>
                        <div class="row col-lg-12">
                            <h3><b>Dashboard</b></h3>
                        </div>

                        
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

