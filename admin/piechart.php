<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://codingbirdsonline.com/wp-content/uploads/2019/12/cropped-coding-birds-favicon-2-1-192x192.png" type="image/x-icon">
    <script src="https://code.highcharts.com/highcharts.js"></script>
   
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>How to create a dynamic pie chart - Coding Birds Online</title>
    <style>
        .container {
            background: transparent; /* Set the background of the container to transparent */
        }
        .center-block { display: block; margin-left: auto; margin-right: auto; }
        
    </style>
</head>
<body>
<div class="container">
    <center>
        <div id="container"></div>
    </center>
</div>

<?php
$con = new mysqli('localhost', 'root', '', 'capstone_db');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$query = $con->query("
    SELECT 
      strand,
      COUNT(patientid) as count
    FROM patient
    GROUP BY strand
");

if ($query === false) {
    die("Query failed: " . $con->error);
}
?>

<script>
    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            backgroundColor: 'rgba(0, 0, 0, 0)'
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Strand '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true,
                size: '48%' // Adjusted size to match the bar chart
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_object()) {
                        $data .= '{ name: "'.$row->strand.'", y: '.$row->count.'},';
                    }
                }
                echo $data;
                ?>
            ]
        }]
    });
</script>

</body>
</html>
