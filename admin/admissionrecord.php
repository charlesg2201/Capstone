<!DOCTYPE html>
<html lang="en">
<style>
      .box-header {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50px; /* Set your desired height */
  background-color: #0a4b78;
  color: white;
  font-weight: bold;
}

.box-header h4 {
  margin: 0;
}                  

title{
    text-align: center;
    margin-left: 100px;
}

.print-logo, .text-between-logos {
            display: none;
        }
        img{
            width: 10%;
                max-height: 100px;
                
            }

            .logo-container {
                display: flex;
                justify-content: space-between;
                margin-bottom: 100px;
            }
            
            body {
                background-image: none !important;
            }

        @media print {
            .print-only{
                display: block;
            }
            .print-logo {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
    
            
            }
            .text-between-logos{
                display: block;
                text-align: center;
                font-size: 25px;
            
            }
            .logo-container {
                display: flex;
                justify-content: space-between;
                margin-bottom: 100px;
            }

            .logo-container img {
                margin-top: 30px;
                margin-right: 20px; /* Adjust as needed */
            }
            img{
                width: 10%;
                max-height: 100px;
            }
            
            #dom-jqry_wrapper {
                margin-top: 100px; /* Adjust as needed */
            }

            body {
                background-image: none !important;
            }
        }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Record</title>
    <script type="text/javascript" charset="utf8" src="..\jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="..\jquery.slimscroll.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables/datatables.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables\DataTables-1.13.8\css\dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables\DataTables-1.13.8\js\dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\Datatables\Buttons-2.4.2\css\buttons.dataTables.css">
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.print.js"></script>

</head>

<body>

<?php
date_default_timezone_set("Asia/Manila");
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');
?>
<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Admission Record</h4></div>
                    <br>
                        <div class="card-block">
       
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Nav tabs -->

                        <div class="tab-pane" id="appointment" role="tabpanel">
                            <p class="m-0">
                                <div class="table-responsive dt-responsive">
                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>LRN Number</th>
                                                <th>Name</th>
                                                <th>Grade Level</th>
                                                <th>Section</th>
                                                <th>Admission Date</th>
                                                <th>Admission Time</th>
                                                <th>Reason</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
// Check if 'delete_status' is set to 0 in the URL
if (isset($_GET['delete_status']) && $_GET['delete_status'] == 0) {
    $sql = "SELECT a.lrn_number, CONCAT(a.fname, ' ', a.lname) AS full_name, a.grade_level, a.section, b.admission_date, b.admission_time, b.reasons, b.remarks
            FROM patient a
            INNER JOIN tbl_admission b ON a.patientid = b.patientid
            WHERE b.delete_status = 0";

    $qsql = mysqli_query($conn, $sql);

    while ($rs = mysqli_fetch_array($qsql)) {
        echo "<tr>
            <td>$rs[lrn_number]</td>
            <td>$rs[full_name]</td>
            <td>$rs[grade_level]</td>
            <td>$rs[section]</td>
            <td>$rs[admission_date]</td>
            <td>$rs[admission_time]</td>
            <td>$rs[reasons]</td>
            <td>$rs[remarks]</td>
        </tr>";
    }
} else {
    echo "Invalid delete_status value or not provided in the URL.";
}
?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </p>
                        </div>

                        <div id="#">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>
    <div class="logo-container">
        <img src="uploadImage/Logo/shslogo.png" class="print-logo">
        <p class="text-between-logos">
                                <strong>City of Tagaytay <br>
                                CITY COLLEGE OF TAGAYTAY <br>
                                Akle St., Kaybagal South, Tagaytay City <br>
                                Telephone No: (046) 482-6840</strong>
                            </p>
        <img src="uploadImage/Logo/Seal_of_Tagaytay_City.svg.png" class="print-logo">
    </div>
    
    <?php
$firstname = ""; // Initialize the variables to avoid "undefined variable" notices
$lastname = "";

if(isset($_SESSION['firstname'])) {
    $firstname = $_SESSION['firstname'];
}

if(isset($_SESSION['lastname'])) {
    $lastname = $_SESSION['lastname'];
}



?>
<p class="print-only" style="color: #0a4b78; padding-left: 80px; margin-top: 100px;"><strong>______________________________________</strong></p>
<p class="print-only" style="color: #0a4b78;"><strong>Printed by: <?php echo $firstname . ' ' . $lastname; ?></strong></p>

    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.print.js"></script>

    <script>
        $(window).on('load', function() {
    // Check if DataTable is already initialized
    if (!$.fn.DataTable.isDataTable('#dom-jqry')) {
        // If not initialized, initialize DataTable
        $('#dom-jqry').DataTable({
            "dom": 'Bfrtip',
            "buttons": [{
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).prepend('<div class="logo-container"><img src="uploadImage/Logo/Seal_of_Tagaytay_City.svg.png" /><p class="text-between-logos"><strong>City of Tagaytay <br>CITY COLLEGE OF TAGAYTAY <br>Akle St., Kaybagal South, Tagaytay City <br>Telephone No: (046) 482-6840</strong></p><img src="uploadImage/Logo/shslogo.png" /></div>');
                    $(win.document.body).append('<p class="print-only" style=" padding-left: 90px; margin-top: 100px;"><strong>______________________________________</strong></p>');
                    $(win.document.body).append('<p class="print-only" style=" font-size: 20px;"><strong>Printed by: <?php echo $firstname . ' ' . $lastname; ?></strong></p>');
                }
            }]
        });
    }
});
    </script>
</body>
</html>

