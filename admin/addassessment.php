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
                <h2>Add Assessment</h2>
			<?php 
		include( "connect.php" );
		if ( isset( $_POST[ 'submit' ] ) ) {

			$Aname = $_POST[ 'AssessmentType' ];
			$q1 = $_POST[ 'Q1' ];
			$q2 = $_POST[ 'Q2' ];
			$q3 = $_POST[ 'Q3' ];
			$q4 = $_POST[ 'Q4' ];
			$q5 = $_POST[ 'Q5' ];
		
			 // Check if the Assessment Type already exists in the database
			 $checkDuplicateQuery = "SELECT COUNT(*) FROM tbl_assessment WHERE ExamName = '$Aname'";
			 $result = mysqli_query($conn, $checkDuplicateQuery);
			 $row = mysqli_fetch_row($result);
			 $count = $row[0];
		 
			 if ($count > 0) {
				?>
				 <div class="popup popup--icon -error js_error-popup popup--visible">
				<div class="popup__background"></div>
				<div class="popup__content">
					<h3 class="popup__content__title">
					Error 
					</h3>
					<p>Assessment Type already exists.</p>
					<p>
					<a href="addassessment.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
					</p>
				</div>
				</div>
	<?php
				
			 } else {
				 // Add Assessment if it's not a duplicate
			//Add Assessment
			$sql = "INSERT INTO `tbl_assessment` (`ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`) VALUES ('$Aname','$q1','$q2','$q3','$q4','$q5')";
			if($qsql = mysqli_query($conn,$sql))
        {

?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success
                </h3>
                <p>Assessment added Successfully!</p>
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
}

		?>
		
			<fieldset>
				<!--<legend><a href="addassessment.php">Add Assessment</a></legend>-->
				<form action="" method="POST" name="AddAssessment">
					<table class="table table-hover">
						<tr>
						<div class="form-group row">
    <label class="col-sm-2 col-form-label">Assessment Type</label>
    <div class="col-sm-3">
        <select name="AssessmentType" id="ExamName" class="form-control" required>
            <option value="">-- Select One --</option>
            <?php
            $examNames = ["Psychological", "Health"];
            foreach ($examNames as $name) {
                $selected = isset($_GET['editid']) && $rsedit['ExamName'] == $name ? 'selected' : '';
                echo "<option value=\"$name\" $selected>$name</option>";
            }
            ?>
        </select>
    </div>
</div>


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

	<?php include('footer.php'); ?>