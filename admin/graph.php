<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    #myChartContainer {
      width: 48%; 
      max-width: 500px; 
      margin: 40px 0; 
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
      float: left; 
    }
</style>
</head>
<body>

<?php
$con = new mysqli('localhost', 'root', '', 'capstone_db');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Initialize an array with all months and set the patient count to zero for each month
$allMonths = [
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
];
$monthData = array_fill_keys($allMonths, 0);

$query = $con->query("
    SELECT 
      MONTHNAME(admission_date) as monthname,
      COUNT(patientid) as patient_count
    FROM tbl_admission
    GROUP BY monthname
");

if ($query === false) {
    die("Query failed: " . $con->error);
}

while ($data = $query->fetch_assoc()) {
    // Update the patient count for the corresponding month
    $monthData[$data['monthname']] = $data['patient_count'];
}

// Extract the month names and patient counts from the associative array
$month = array_keys($monthData);
$patientCount = array_values($monthData);
?>

<div id="myChartContainer">
  <canvas id="myChart"></canvas>
</div>
 
<script>
const labels = <?php echo json_encode($month) ?>;

const data = {
  labels: labels,
  datasets: [{
    data: <?php echo json_encode($patientCount) ?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.7)',
      'rgba(255, 159, 64, 0.7)',
      'rgba(255, 205, 86, 0.7)',
      'rgba(75, 192, 192, 0.7)',
      'rgba(54, 162, 235, 0.7)',
      'rgba(153, 102, 255, 0.7)',
      'rgba(201, 203, 207, 0.7)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 2
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {
    plugins: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: 'Number of Assessed Students',
        font: {
          size: 18,
          weight: 'bold',
        },
      },
    },
    scales: {
      x: {
        grid: {
          display: false,
        },
      },
      y: {
        beginAtZero: true,
        ticks: {
          callback: function (value) {
            return Number.isInteger(value) ? value : '';
          },
        },
      },
    },
  },
};

var myChart = new Chart(
  document.getElementById('myChart'),
  config
);
</script>
</body>
</html>
