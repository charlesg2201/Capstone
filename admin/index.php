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
                        <?php  if ($_SESSION['user'] == 'tbl_admin_user') { ?>
                            <div class="col-xl-4 col-md-6">             
                                <div class="card border-primary" style="border-width: 3px; padding: 5px;"> 
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                            <div class="col-8">
                                                <h4 class="text-dark">
                                                    <?php
                                                    $sql = "SELECT * FROM patient WHERE delete_status='0'";
                                                    $qsql = mysqli_query($conn, $sql);
                                                    echo mysqli_num_rows($qsql);
                                                    ?>
                                                </h4>
                                                <h6 class="text-dark m-b-0">Total Patients</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span class="pcoded-micon" style="font-size: 3rem;"><i class="feather icon-users"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-4 col-md-6">             
                            <div class="card border-primary" style="border-width: 3px; padding: 5px;"> 
                                <div class="card-body">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-dark">
                                                <?php
                                                $sql = "SELECT * FROM tbl_admin_user WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn, $sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-dark m-b-0">Clinic Coordinator</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span class="pcoded-micon" style="font-size: 3rem;"><i class="feather icon-user"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <iframe src="graph.php" frameborder="0" width="100%" height="450"></iframe>
                        <div style="display: flex; margin: 40px auto;">
                            <iframe src="piechart.php" frameborder="0" width="48%" height="600"></iframe>
                            <iframe src="piechart2.php" frameborder="0" width="48%" height="600"></iframe>
                        </div>


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


<!-- <div style="width: 750px; margin: 0 auto;">
                        <div>
    <canvas id="patientChart"></canvas>
  </div>

  <script>
    //Assuming you have patient record data in PHP
    //<?php
      // Example data (replace this with your actual data)
      //$patientRecords = [
    //   ['Monday', 3],
      //  ['Tuesday', 4],
      //  ['Wednesday', 6],
     //   ['Thursday', 7],
     //   ['Friday', 2]
    //  ];
  ?>
 
     // Convert PHP data to JavaScript variables
     var patientData = <?php echo json_encode($patientRecords); ?>;
 
     // Extract labels and data from the PHP array
     var labels = patientData.map(record => record[0]);
     var data = patientData.map(record => record[1]);
 
     // Create the chart using Chart.js
     var ctx = document.getElementById('patientChart').getContext('2d');
     var patientChart = new Chart(ctx, {
       type: 'bar',
       data: {
         labels: labels,
         datasets: [{
           label: 'Total Patients per Week',
           data: data,
           backgroundColor: 'rgba(75, 192, 192, 0.6)', // Set desired color
           borderColor: 'rgba(75, 192, 192, 1)',
           borderWidth: 1
         }]
       },
       options: {
         responsive: true,
         scales: {
           y: {
             beginAtZero: true,
             stepSize: 1 // Set the step size for y-axis ticks
           }
         }
       }
     });
   </script>
 </script> zzzzz-->
