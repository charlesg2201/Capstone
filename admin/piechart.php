<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</head>
<body>
<style>
        .chart-container {
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
           margin: 0;
            height: 258px; /* Adjust the height as needed */
        }

        #container {
            height: 300px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="chart-container">
    <div id="container"></div>
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
            backgroundColor: 'rgba(0, 0, 0, 0)',
            marginTop: -20, // Adjusted marginTop to align the title with the chart
            marginBottom: 10,
            marginLeft: -20, // Adjusted marginLeft to move the chart to the left
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Strand',
            x: -20, // Adjusted x to move the title to the left
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
                size: '68%', // Adjusted size to make the pie chart smaller
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right', // Align the legend to the right
            verticalAlign: 'middle', // Align the legend in the middle vertically
            borderWidth: 0, // No border around the legend
            floating: true,
            x: 10, // Adjusted x to move the legend to the left
            y: -10, // Adjusted y to control the vertical position of the legend
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
