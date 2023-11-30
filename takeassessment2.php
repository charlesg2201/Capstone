<title>Patient</title>
<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="sub-title">
                
				<?php
				$exid = $_GET['exid'];
				include('connect.php');
				
				$sql2 = "select * from tbl_assessment where ExamID='$exid'";
				
				$result = mysqli_query($conn, $sql);
				$result2 = mysqli_query($conn, $sql2);
				
				while ($row = mysqli_fetch_array($result)) {
				?>
				<!-- Exam question with student details -->
				<br>
				<fieldset>
					<legend>Assessment Details</legend>
					<form action="" method="POST" name="update">
						<br>
						<hr>
						<?php while ($row = mysqli_fetch_array($result2)) {
						?>
						<div class="col-md-12">
							<span><h5>Answer The Following Questions..</h5></span>

							<br>
							<div>
								<h5><strong>Q1. <?php $Q_1 = $row['Q1']; echo $Q_1; ?></strong></h5>
								<div>
									<br>
									<label><input type="radio" name="Q1" value="Yes" required> Yes</label><br>
									<label><input type="radio" name="Q1" value="No" required> No</label><br>
								</div>
							</div>
							<br>
							<div>
								<h5><strong>Q2. <?php $Q_2 = $row['Q2']; echo $Q_2; ?></strong></h5>
								<div>
									<br>
									<label><input type="radio" name="Q2" value="Yes" required> Yes</label><br>
									<label><input type="radio" name="Q2" value="No" required> No</label><br>
								</div>
							</div>
							<br>
							<div>
								<h5><strong>Q3. <?php $Q_3 = $row['Q3']; echo $Q_3; ?></strong></h5>
								<div>
									<br>
									<label><input type="radio" name="Q3" value="Yes" required> Yes</label><br>
									<label><input type="radio" name="Q3" value="No" required> No</label><br>
								</div>
							</div>
							<br>
							<div>
								<h5><strong>Q4. <?php $Q_4 = $row['Q4']; echo $Q_4; ?></strong></h5>
								<div>
									<br>
									<label><input type="radio" name="Q4" value="Yes" required> Yes</label><br>
									<label><input type="radio" name="Q4" value="No" required> No</label><br>
								</div>
							</div>
							<br>
							<div>
								<h5><strong>Q5. <?php $Q_5 = $row['Q5']; echo $Q_5; ?></strong></h5>
								<div>
									<br>
									<label><input type="radio" name="Q5" value="Yes" required> Yes</label><br>
									<label><input type="radio" name="Q5" value="No" required> No</label><br>
								</div>
							</div>
							<br>

							<?php 
							}
							?>

							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</fieldset>
				<?php
				}

				if (isset($_POST['submit'])) {
					$Ex_id = $exid;
					
					$q1 = $_POST['Q1'];
					$q2 = $_POST['Q2'];
					$q3 = $_POST['Q3'];
					$q4 = $_POST['Q4'];
					$q5 = $_POST['Q5'];
					$sql = "INSERT INTO `tbl_assessment_result`(ExamID, Ans1, Ans2, Ans3, Ans4, Ans5) VALUES ($Ex_id,'$q1','$q2','$q3','$q4','$q5')";
					if ($qsql = mysqli_query($conn, $sql)) {
					?>
					<div class="popup popup--icon -success js_success-popup popup--visible">
						<div class="popup__background"></div>
						<div class="popup__content">
							<h3 class="popup__content__title">
								Success
							</h3>
							<p>Assessment Have Submitted!</p>
							<p>
								<?php echo "<script>setTimeout(\"location.href = 'takeassessment2.php';\",1500);</script>"; ?>
							</p>
						</div>
					</div>
					<?php
					} else {
						echo mysqli_error($conn);
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>
