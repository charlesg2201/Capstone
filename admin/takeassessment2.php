<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if ( $_SESSION[ "id" ] == "" || $_SESSION[ "id" ] == NULL ) {
	header( 'Location:login' );
}

$userid = $_SESSION[ "id" ];
$fname = $_SESSION[ "firstname" ];
?> 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="sub-title">
                <h2>Welcome <?php echo '' . $_SESSION['firstname']; ?>!</h2>
				<?php 
				$exid = $_GET[ 'exid' ];
			
				include( 'connect.php' );
				
				$sql = "select * from  examdetails where ExamID='$exid'";
				
				$result = mysqli_query( $conn, $sql );

				while($row=mysqli_fetch_array($result)) {
				?>
					<hr>
					<div class="col-md-12">
						<span><h4>Answer The Following Questions...</h4></span>

						<br>
						<div>
	<h5><strong>Q1. <?php $Q_1=$row['Q1']; echo $Q_1; ?></strong></h5>
	<div><br>
		<label><input type="radio" name="Q1" value="Choice 1" required> Yes</label><br>
		<label><input type="radio" name="Q1" value="Choice 2" required> No</label><br>
		
	</div>
</div>
<br>
<div>
	<h5><strong>Q2. <?php $Q_2=$row['Q2']; echo $Q_2; ?></strong></h5>
	<div><br>
		<label><input type="radio" name="Q2" value="Choice 1" required> Yes</label><br>
		<label><input type="radio" name="Q2" value="Choice 2" required> No</label><br>
		
	</div>
</div>
<br>
<div>
	<h5><strong>Q3. <?php $Q_3=$row['Q3']; echo $Q_3; ?></strong></h5>
	<div><br>
		<label><input type="radio" name="Q3" value="Choice 1" required> Yes</label><br>
		<label><input type="radio" name="Q3" value="Choice 2" required> No</label><br>
		
	</div>
</div>
<br>
<div>
	<h5><strong>Q4. <?php $Q_4=$row['Q4']; echo $Q_4; ?></strong></h5>
	<div><br>
		<label><input type="radio" name="Q4" value="Choice 1" required> Yes </label><br>
		<label><input type="radio" name="Q4" value="Choice 2" required> No</label><br>
	
	</div>
</div>
<br>
<div>
	<h5><strong>Q5. <?php $Q_5=$row['Q5']; echo $Q_5; ?></strong></h5>
	<div><br>
		<label><input type="radio" name="Q5" value="Choice 1" required> Yes </label><br>
		<label><input type="radio" name="Q5" value="Choice 2" required> No </label><br>
		
	</div>
</div>

		<?php 
			  }
					?>
							
						<br><br>
						<button type="submit" name="done" class="btn btn-primary">Submit</button>
					</div>
					
				</form>
			</fieldset>
			<?php
			
			if ( isset( $_POST[ 'done' ] ) ) {
				$Ex_id = $exid;
				$sEno = $sEno;
				$tempsname = $name;
				$tempq1 = $_POST[ 'Q1' ];
				$tempq2 = $_POST[ 'Q2' ];
				$tempq3 = $_POST[ 'Q3' ];
				$tempq4 = $_POST[ 'Q4' ];
				$tempq5 = $_POST[ 'Q5' ];
				$sql = "INSERT INTO `examans`(ExamID, Senrl, Sname, Ans1, Ans2, Ans3, 	Ans4, Ans5) VALUES ($Ex_id,'$sEno','$tempsname','$tempq1','$tempq2','$tempq3','$tempq4','$tempq5')";
				if ( mysqli_query( $conn, $sql ) ) {
					echo "<br>
					<br><br>
					<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Success!</strong> Assessment Have Submited.
					</div>";
				} else {
					//error message if SQL query fails
					echo "<br><Strong>Assessment Submitting Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
				} //close the connection
				mysqli_close( $conn );
			}
			?>
			</table>
			
		</div>
	</div>
	<?php include('footer.php'); ?>