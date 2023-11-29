<!DOCTYPE html>
<html lang="en">


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
                        <div class="card-header"><h1>Physical Assessment</h1></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>Number</th>
                      <th>Questions</th>
                      <th>Choices</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM tbl_physical where select_all='1'";
                      $qsql = mysqli_query($conn, $sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr>
                          <td>$rs[question_id]</td> 
                          <td>$rs[questions]<br>
                        
                          <td align=''>";

                       

                        echo "</td></tr>";
                      }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    </tr>
                  </tfoot>
                </table>
                <?php
                     if(isset($_SESSION['userid']))
                     {
                       echo "<a href='addquestion.php' class='btn btn-primary'>Add</a>
                             <a href='' class='btn btn-primary'>Edit</a>
                             <a href='' class='btn btn-primary'>View</a>
                             <a href='' class='btn btn-primary'>Delete</a>";

                       //<!--<a href='patientreport.php?patientid=$rs[patientid]' class='btn btn-success'>View Report</a>";
                     }   
                ?>
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


