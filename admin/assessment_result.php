<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Report</title>
    <script type="text/javascript" charset="utf8" src="..\jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="..\jquery.slimscroll.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables/datatables.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables\DataTables-1.13.8\css\dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables\DataTables-1.13.8\js\dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\Datatables\Buttons-2.4.2\css\buttons.dataTables.css">
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.print.js"></script>

</head>

<body>
    <?php date_default_timezone_set("Asia/Manila"); ?>
    <?php require_once('check_login.php');?>
    <?php include('head.php');?>
    <?php include('header.php');?>
    <?php include('sidebar.php');?>
    <?php include('connect.php');?>

    <div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-header">
          <div class="row align-items-end">
            <div class="col-lg-8">
              <div class="page-header-title">
                <div class="d-inline">
                  <h2>Assessment Results</h2>
                  <br>
                </div>
              </div>
            </div>
        </div>

        <div class="page-body">
          <div class="card">
            <div class="card-header"></div>
            <div class="card-block">
              <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <table id="dom-jqry" class='table table-striped table-bordered nowrap'>
			<?php 
				$sql = "SELECT a.*, p.lrn_number, p.fname, p.lname
						FROM tbl_assessment_result a
						JOIN patient p ON a.delete_status = p.delete_status";
				$rs = mysqli_query($conn, $sql);
        
				//echo "<h4 class='page-header'>Assessment Result</h4>";
				echo "
        
				<tr>
        <thead>
					<th>LRN ID</th>
					<th>Name</th>
					<th>Assessment Type</th>
					<th>Answers</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
						
				</tr>
          </thead>";
				while($row=mysqli_fetch_array($rs))
				{
				?>
			<tr>
				<td>
					<?PHP echo $row['lrn_number'];?>
				</td>
				<td>
					<?php echo $row['fname'] . ' ' . $row['lname']; ?>
				</td>
				<td>
					<?PHP 
						if ($row['ExamID'] == 1) {
							echo "Physical";
						} elseif ($row['ExamID'] == 2) {
							echo "Health";
						} else {
							echo $row['ExamID']; // Print the ExamID if it's neither 1 nor 2
						}
					?>
				</td>
				<td>
					<?PHP echo $row['Ans1'];?>
				</td>
				<td>
					<?PHP echo $row['Ans2'];?>
				</td>
				<td>
					<?PHP echo $row['Ans3'];?>
				</td>
				<td>
					<?PHP echo $row['Ans4'];?>
				</td>
				<td>
					<?PHP echo $row['Ans5'];?>
				</td>
				
			</tr>
			<?php
			}
			?>	
			</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php');?>

    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.print.js"></script>

    <script>
        $(window).on('load', function() {
            // Check if DataTable is already initialized
            if (!$.fn.DataTable.isDataTable('#dom-jqry')) {
                // If not initialized, initialize DataTable
                $('#dom-jqry').DataTable({
                    "dom": 'Bfrtip',
                    "buttons": [
                        'copy', 'excel', 'pdf', 'print'
                    ]
                });
            }
        });
    </script>
</body>
</html>


