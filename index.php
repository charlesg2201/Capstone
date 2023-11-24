<title>Patient</title>
<?php
require_once('check_login.php'); 
include('head.php'); 
include('header.php'); 
include('sidebar.php'); 
include('connect.php'); 

$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
$qsqlpatient = mysqli_query($conn, $sqlpatient);
$patient = mysqli_fetch_array($qsqlpatient);

?>
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" style="margin: 0 auto;">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sub-title">
                            <h2>Welcome <?php echo '' . $_SESSION['firstname']; ?></h2>
                        </div>
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
