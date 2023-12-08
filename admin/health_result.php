<!DOCTYPE html>
<html lang="en">
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
                    <div class="card-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold; margin: 20px 20px 0 20px;"><h1>Health Assessment Results</h1></div>
                    <br>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>LRN Number</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
				
        </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT DISTINCT pr.lrn_number, u.fname, u.lname 
                      FROM tbl_health_results pr
                      JOIN patient u ON pr.lrn_number = u.lrn_number
                      WHERE pr.delete_status = '0'";
                      $qsql = mysqli_query($conn, $sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr>
                          <td>$rs[lrn_number]</td> 
                          <td>$rs[fname] $rs[lname]<br>
                         
                          <td >";
                        
                          echo "<a href='viewhealth_result.php?lrn_number=$rs[lrn_number]' class='btn btn-primary'>View</a>";
                        

                        echo "</td></tr>";
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


