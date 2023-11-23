<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>

<?php
// Establish a database connection using mysqli
$con = new mysqli('localhost', 'root', '', 'capstone_db');

// Check if the connection was successful
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Execute an SQL query to retrieve the count of distinct patients for each month
$query = $con->query("
    SELECT 
      MONTHNAME(admissiondate) as monthname,
      COUNT(patientid) as patient_count
    FROM patient
    GROUP BY monthname
");

if ($query === false) {
    die("Query failed: " . $con->error);
}

// Initialize an empty array to store month data
$month = [];

// Initialize an empty array to store the patient count data
$patientCount = [];

// Fetch and iterate over the rows of the result set
while ($data = $query->fetch_assoc()) {
    // Add the 'monthname' value from the current row to the $month array
    $month[] = $data['monthname'];
    
    // Add the 'patient_count' value from the current row to the $patientCount array
    $patientCount[] = $data['patient_count'];
}
?>

<!-- Rest of your HTML and JavaScript code -->


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  // ...
const labels = <?php echo json_encode($month) ?>;

const data = {
  labels: labels,
  datasets: [{
    label: 'Number of Patients',
    data: <?php echo json_encode($patientCount) ?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
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
    borderWidth: 1
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
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
// ...


</script>
</body>
</html>
