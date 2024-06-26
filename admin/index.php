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
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;"> <?php
                                                    $sql = "SELECT * FROM patient WHERE delete_status='0'";
                                                    $qsql = mysqli_query($conn, $sql);
                                                    echo mysqli_num_rows($qsql);
                                                    ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="view-patient.php" style="color: #ffffff; font-size: 12px;">Total Patients</a>
                                        <div class="small text-white"><i class="feather icon-users" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Physical Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="viewall_p.php" style="color: #ffffff; font-size: 12px;">View Assessment</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                    <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Health Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="viewall_h.php" style="color: #ffffff; font-size: 12px;">View Assessment</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                        <iframe src="graph2.php" frameborder="0" width="70%" height="250" style="height: 260px; margin-top: -20px;"></iframe>
                            <iframe src="piechart.php" frameborder="0" width="30%" height="250" style="height: 350px; margin-top: -27px;"></iframe>
                            <iframe src="graph.php" frameborder="0" width="70%" height="250" style="height: 260px; margin-top: -80px;"></iframe>
                        
                            
                    
                            <iframe src="piechart2.php" frameborder="0" width="30%"height="250" style="height: 350px; margin-top: -88px;" ></iframe>
                        


                       
                
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
 
     // Convert PHP data to JavaScript variablesasdsadsdsda
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
