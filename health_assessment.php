<title>Patient</title>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

$userid = $_SESSION[ "id" ];
$fname = $_SESSION[ "firstname" ];
?> 


<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header"><legend>Health Assessment</legend></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
			<?php 

				include('connect.php');
				
				$rs=mysqli_query($conn,$sql);

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
                    <?PHP echo 'Health'?>
				</td>
				<td>
					<a href="health.php"> <button type="submit" class="btn btn-primary">Take</button></a>
                    <!-- <a href="takeassessment2.php?exid=<?php echo $row['ExamID']; ?>"> <button type="submit" class="btn btn-primary">Take</button></a> -->
				</td>
			</tr>
			<?php
			}
			?>
			</table>
			
		</div>
	</div>
	<?php include('footer.php'); ?>