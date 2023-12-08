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
                        <div class="card-header"><legend>Admission Record</legend></div>
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
    $sql = "SELECT a.lrn_number, CONCAT(a.fname, ' ', a.lname) AS full_name, b.admission_date, b.admission_time, b.reasons, b.remarks
            FROM patient a
            INNER JOIN tbl_admission b ON a.patientid = b.patientid
            WHERE b.delete_status = 0";

    $qsql = mysqli_query($conn, $sql);

    while ($rs = mysqli_fetch_array($qsql)) {
        echo "<tr>
            <td>$rs[lrn_number]</td>
            <td>$rs[full_name]</td>
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

<?php include('footer.php'); ?>
