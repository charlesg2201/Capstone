<title>Patient</title>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

$userid = $_SESSION[ "id" ];
$fname = $_SESSION[ "firstname" ];
?> 


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="sub-title">
                <h2>Assessments</h2>
			<?php 

				include('connect.php');
				
				//below query will print the existing record of Assessment
				$sql="SELECT * FROM tbl_assessment";
				$rs=mysqli_query($conn,$sql);
				//echo "<h3 class='page-header'>Take Assessment</h3>";
				echo "<table class='table table-striped' style='width:100%'>
				<tr>
				<th>Assessment Type</th>
				<th>Take</th>					
				</tr>";
				while($row=mysqli_fetch_array($rs))
				{
			?>
			<tr>
			
				<td>
					<?PHP echo $row['ExamName'];?>
				</td>
				<td>
					<a href="takeassessment2.php?exid=<?php echo $row['ExamID']; ?>"> <button type="submit" class="btn btn-primary">Take</button></a>
				</td>
			</tr>
			<?php
			}
			?>
			</table>
			
		</div>
	</div>
	<?php include('footer.php'); ?>