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
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Coordinator</title>
</head>

<body>
    <?php date_default_timezone_set("Asia/Manila"); ?>
    <?php require_once('check_login.php');?>
    <?php include('head.php');?>
    <?php include('header.php');?>
    <?php include('sidebar.php');?>
    <?php include('connect.php');?>

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
<li class="breadcrumb-item">Health Remarks</a></li>

</ul>
</div>
</div>
</div>
</div>
                <div class="page-body">
                    <div class="card">

</ul>
</div>
</div>
</div>
</div>
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Health Assessment Remarks</h4></div>
                        <br>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Admission ID</th>
                                            <th>Reason</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$sql = "SELECT a.admission_id, a.reasons, GROUP_CONCAT(DISTINCT rm.remarks SEPARATOR ', ') AS combined_remarks
FROM tbl_admission a
INNER JOIN tbl_health_results hr ON a.admission_id = hr.admission_id
INNER JOIN tbl_health_remarks rm ON hr.admission_id = rm.admission_id
GROUP BY a.admission_id";

$qsql = mysqli_query($conn, $sql);

while ($rs = mysqli_fetch_array($qsql)) {
echo "<tr>
      <td>$rs[admission_id]</td> 
      <td>$rs[reasons]</td>
      <td>$rs[combined_remarks]</td>
  </tr>";
}

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php');?>
</body>
</html>
