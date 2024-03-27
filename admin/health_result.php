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
                <div class="page-body">
                    <div class="card">
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Health Assessment Results</h4></div>
                    <br>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                            <thead>
          <tr>
            <th>LRN Number</th>
            <th>Admission ID</th>
            <th>Name</th>
            <th>Reason</th>
            <th>Action</th>
          </tr>
				
        </thead>
                  <tbody>
                  <?php
$sql = "SELECT DISTINCT hr.admission_id, hr.lrn_number, u.fname, u.lname, hr.reasons
        FROM tbl_health_results hr
        INNER JOIN tbl_admission u ON hr.admission_id = u.admission_id
        WHERE hr.delete_status = '0'";

$qsql = mysqli_query($conn, $sql);

while ($rs = mysqli_fetch_array($qsql)) {
    echo "<tr>
              <td>$rs[lrn_number]</td> 
              <td>$rs[admission_id]</td> 
              <td>$rs[fname] $rs[lname]</td>
              <td>$rs[reasons]</td>
              <td>
                  <a href='viewhealth_result.php?lrn_number={$rs['lrn_number']}&admission_id={$rs['admission_id']}' class='btn btn-primary'>View</a>
              </td>
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


