<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_GET['id']))
{
  $sql ="UPDATE tbl_assessment SET delete_status='1' WHERE ExamID='$_GET[id]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Assessment record deleted successfully!</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'manageassessment.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
  
  }
}
?>
<?php
if(isset($_GET['delid']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="manageassessment.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="manageassessment.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-header">
          <div class="row align-items-end">
            <div class="col-lg-8">
              <div class="page-header-title">
                <div class="d-inline">
                  <h2>Manage Assessment</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="card">
            <div class="card-block">
              <div class="table-responsive dt-responsive">
                <table class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      
                      <th>Type</th>
                      <th>Q1</th>
                      <th>Q2</th>
                      <th>Q3</th>
                      <th>Q4</th>
                      <th>Q5</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                         
                    <?php
                      $sql ="SELECT * FROM tbl_assessment where delete_status='0'";
                      $qsql = mysqli_query($conn,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr>
                           
                            <td>$rs[ExamName]</td>
                            <td>$rs[Q1]</td>
                            <td>$rs[Q2]</td>
                            <td>$rs[Q3]</td>
                            <td>$rs[Q4]</td>
                            <td>$rs[Q5]</td>
                            <td align='center'>";
                        if(isset($_SESSION['userid']))
                        {
                          echo "<a href='manageassessment2.php?editid=$rs[ExamID]' class='btn btn-primary'>Update</a>";
                            
                        }
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
</div>

<tr>
    
</tr>
</tfoot>
</table>
</div>
</div>
</div>

</div>

</div>
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
