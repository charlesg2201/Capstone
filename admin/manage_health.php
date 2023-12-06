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
                        <div class="card-header"><legend>Health Assessment</legend></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>Questions</th>
                      <th style="width: 30px;">Question Type</th>
                      <th style="width: 30px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM tbl_health where select_all='0'";
                      $qsql = mysqli_query($conn, $sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr>
                          <td>$rs[questions]<br>
                          <td>$rs[question_type]<br>
                          <td align=''>";

                       

                          if(isset($_SESSION['userid']))
                          {
                            echo "<a href='addquestion_h.php?editid=$rs[question_id]' class='btn btn-primary'>Edit</a>
                            <a href='deletequestion_h.php?deleteid=$rs[question_id]' class='btn btn-danger'>Delete</a>";
                          }
  
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
                       echo "<a href='addquestion_h.php' class='btn btn-primary'>Add Question</a>
                             <a href='viewall_h.php' class='btn btn-primary'>View All</a>";

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