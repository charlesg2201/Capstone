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

				<a href="addassessment.php">
                <button href="" type="submit" class="btn btn-primary">Add Assessment</button>
            </a>
            <a href="manageassessment.php">
                <button href="" type="submit" class="btn btn-primary">Manage Assessment</button>
            </a>
        </div>
    </div>
</div>

	
	

<?php include('footer.php');?>
