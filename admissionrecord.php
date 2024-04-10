<!DOCTYPE html>
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
    </style>
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
            <div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">

<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i> Home</a></li>
<li class="breadcrumb-item"><i class="feather icon-record"></i> Admission Record</a></li>

</ul>
</div>
</div>
</div>
</div>
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
                                                <th>Admission Date</th>
                                                <th>Admission Time</th>
                                                <th>Reason</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Check if 'patientid' is set in the URL
                                            if (isset($_GET['patientid'])) {
                                                $patientid = $_GET['patientid'];
                                                $sql = "SELECT * FROM tbl_admission WHERE patientid = '$patientid'";
                                                $qsql = mysqli_query($conn, $sql);
                                                while ($rs = mysqli_fetch_array($qsql)) {
                                                    echo "<tr>
                                                    <td>$rs[admission_date]</td>
                                                    <td>$rs[admission_time]</td>
                                                    <td>$rs[reasons]</td>
                                                    <td>$rs[remarks]</td></tr>";
                                                }
                                            } else {
                                                echo "Patient ID not provided in the URL.";
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

<?php include('footer.php'); ?>
</html>
