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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="sub-title">
                <h2>Welcome <?php echo '' . $_SESSION['firstname']; ?>!</h2>
			<?php 
		include( "connect.php" );
		if ( isset( $_POST[ 'submit' ] ) ) {
			$Aname = $_POST[ 'AssessmentName' ];
			$q1 = $_POST[ 'Q1' ];
			$q2 = $_POST[ 'Q2' ];
			$q3 = $_POST[ 'Q3' ];
			$q4 = $_POST[ 'Q4' ];
			$q5 = $_POST[ 'Q5' ];
			
			$done = "
					<center>
					<div class='alert alert-success fade in __web-inspector-hide-shortcut__'' style='margin-top:10px;'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
					<strong><h3 style='margin-top: 10px;
					margin-bottom: 10px;'> Assessment added Sucessfully.</h3>
					</strong>
					</div>
					</center>
					";

			$sql = "INSERT INTO `ExamDetails` (`ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`) VALUES ('$Aname','$q1','$q2','$q3','$q4','$q5')";
			//close the connection
			mysqli_query( $conn, $sql );

			echo $done;
		}

		?>
		
			<fieldset>
				<legend><a href="addassessment.php">Add Assessment</a></legend>
				<form action="" method="POST" name="AddAssessment">
					<table class="table table-hover">

						<tr>
							<td><strong>Assessment Name  </strong>
							</td>
							<td>
								<input type="text" name="AssessmentName">
							</td>

						</tr>
						<tr>
							<td><strong>Question 1</strong> </td>
							<td>
								<textarea name="Q1" rows="4" cols="100"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 2</strong> </td>
							<td>
								<textarea name="Q2" rows="4" cols="100"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 3</strong> </td>
							<td>
								<textarea name="Q3" rows="4" cols="100"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 4</strong> </td>
							<td>
								<textarea name="Q4" rows="4" cols="100"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 5</strong> </td>
							<td>
								<textarea name="Q5" rows="4" cols="100"></textarea>
							</td>
						</tr>
						
						<td><button type="submit" name="submit" class="btn btn-primary">Add Assessment</button>
						</td>
						
					</table>
				</form>
			</fieldset>
		</div>
	</div>
	<?php include('footer.php');  ?>