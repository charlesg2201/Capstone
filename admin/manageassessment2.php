<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if ( $_SESSION[ "userid" ] == "" || $_SESSION[ "userid" ] == NULL ) {
	header( 'Location:login' );
}

$userid = $_SESSION[ "user" ];
$fname = $_SESSION[ "firstname" ];
?> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="sub-title">
                <h2>Update Assessment</h2>

			<?php
			include( 'connect.php' );
			$make = $_GET[ 'editid' ];
			//selecting data form assessment details table form database
			$sql = "SELECT * FROM tbl_assessment WHERE ExamID=$make";
			$rs = mysqli_query( $conn, $sql );
			while ( $row = mysqli_fetch_array( $rs ) )
			 {
				?>
			<fieldset>
				<br>
				
				<form action="" method="POST" name="UpdateAssessment">
					<br>
					<table class="table table-hover">
			
						<tr>
							<td><strong>Q1</strong>
							</td>
							<td>
							<textarea name="Q1" rows="4" cols="100"><?php $Q1=$row['Q1']; echo $Q1; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q2</strong>
							</td>
							<td>
							<textarea name="Q2" rows="4" cols="100"><?php $Q2=$row['Q2']; echo $Q2; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q3</strong>
							</td>
							<td>
							<textarea name="Q3" rows="4" cols="100"><?php $Q3=$row['Q3']; echo $Q3; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q4</strong>
							</td>
							<td>
							<textarea name="Q4" rows="4" cols="100"><?php $Q4=$row['Q4']; echo $Q4; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q5</strong>
							</td>
							<td>
							<textarea name="Q5" rows="4" cols="100"><?php $Q5=$row['Q5']; echo $Q5; ?></textarea>
							</td>
						</tr>	
							
						<td><button type="submit" name="update" class="btn btn-primary">Update</button>
						</td>
						<?php
						}
						?>
						<?php 

							if(isset($_POST['update']))
							{
							
		
							$Q_1= $_POST['Q1'];
							$Q_2= $_POST['Q2'];
							$Q_3= $_POST['Q3'];
							$Q_4= $_POST['Q4'];
							$Q_5= $_POST['Q5'];

							$sql = "UPDATE `tbl_assessment` SET Q1='$Q_1' , Q2='$Q_2' , Q3='$Q_3', Q4='$Q_4', Q5='$Q_5' WHERE ExamID=$make";

							if($qsql = mysqli_query($conn,$sql))
							{
					?>
								<div class="popup popup--icon -success js_success-popup popup--visible">
								  <div class="popup__background"></div>
								  <div class="popup__content">
									<h3 class="popup__content__title">
									  Success
									</h3>
									<p>Assessment Updated!</p>
									<p>
									 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
									 <?php echo "<script>setTimeout(\"location.href = 'manageassessment.php';\",1500);</script>"; ?>
									</p>
								  </div>
								</div>
					<?php
							}
							else
							{
								echo mysqli_error($conn);
							}
						}
							?> 
					</table>
				</form>
			</fieldset>
		</div>
	</div>
	<?php include('footer.php');  ?>