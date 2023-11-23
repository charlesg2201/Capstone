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
                                    <h4>Patient Report</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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
