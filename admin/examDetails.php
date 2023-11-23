
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if ( $_SESSION[ "userid" ] == "" || $_SESSION[ "userid" ] == NULL ) {
	header( 'Location:login' );
}

$userid = $_SESSION[ "userid" ];
$fname = $_SESSION[ "firstname" ];
?> 

		<?php
		include( "connect.php" );
		if ( isset( $_REQUEST[ 'deleteid' ] ) ) {

			//getting data from another page
			$deleteid = $_GET[ 'deleteid' ];
			$sql = "DELETE FROM `tbl_assessment` WHERE ExId = $deleteid";
			if ( mysqli_query( $conn, $sql ) ) {
				echo "
						<br><br>
						<div class='alert alert-success fade in'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<strong>Success!</strong> Exam details deleted.
						</div>
						";
			} else {
				//error message if SQL query fails
				echo "<br><Strong>Exam Details Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
			}
		}
		//close the connection
		mysqli_close( $conn );
		?>
	</div>
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="sub-title">
                <h2>Assessment Result</h2>


				
			<?php 
				
				include('connect.php');
				$sql = "SELECT a.*, p.lrn_number, p.fname, p.lname
						FROM tbl_assessment_result a
						JOIN patient p ON a.delete_status = p.delete_status";
				$rs = mysqli_query($conn, $sql);
				//echo "<h4 class='page-header'>Assessment Result</h4>";
				echo "<table class='table table-striped' style='width:100%'>
				<tr>
					<th>LRN ID</th>
					<th>Name</th>
					<th>Assessment ID</th>
					<th>Answer 1</th>
					<th>Answer 2</th>
					<th>Answer 3</th>
					<th>Answer 4</th>
					<th>Answer 5</th>
						
							
				</tr>";
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
				<!--<td><a href="examDetails.php?deleteid=<?php echo $row['ExamID']; ?>"> <input type="button" Value="Delete"  class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModal"></a>
				</td>-->
				
			</tr>
			<?php
			}
			?>	
			</table>
			
		</div>
	</div>
	<?php include('footer.php');  ?>