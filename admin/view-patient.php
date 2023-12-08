<?php date_default_timezone_set("Asia/Manila"); ?>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_GET['id']))
{
  $sql = "UPDATE patient SET delete_status='1' WHERE patientid='$_GET[id]'";
  $qsql = mysqli_query($conn, $sql);

  if(mysqli_affected_rows($conn) == 1)
  {
?>
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Success
        </h3>
        <p>Patient record deleted successfully.</p>
        <p>
          <?php echo "<script>setTimeout(\"location.href = 'view-patient.php';\", 1500);</script>"; ?>
        </p>
      </div>
    </div>
<?php
  }
}
?>

<?php
if(isset($_GET['delid']))
{
?>
  <div class="popup popup--icon -question js_question-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Sure
      </h1>
      <p>Are You Sure To Delete This Record?</p>
      <p>
        <a href="view-patient.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
        <a href="view-patient.php" class="button button--error" data-for="js_success-popup">No</a>
      </p>
    </div>
  </div>
<?php
}
?>
                        

<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                    <div class="card-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold; margin: 20px 20px 0 20px;"><h1>Student Record</h1></div>

<br>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <!-- <th>Contact Number</th> -->
                      <!-- <th>Email Address</th> -->
                      <th>Strand</th>
                      <th>Grade Level</th>
                      <th>Section</th>
                      <!-- <th>Gender</th> -->
                      <!-- <th>Date of Birth</th> -->
                      <!-- <th>Guardian</th> -->
                      <!-- <th>Guardian's Contact Number</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM patient where delete_status='0'";
                      $qsql = mysqli_query($conn, $sql);
                      while($rs = mysqli_fetch_array($qsql))
                      {
                        echo "<tr>
                          <td>$rs[lrn_number]</td> 
                          <td>$rs[fname] $rs[mname] $rs[lname]<br></td>
                          <td>$rs[strand]</td> 
                          <td>$rs[grade_level]</td> 
                          <td>$rs[section]</td> 
                          <td align='center'>";

                        if(isset($_SESSION['userid']))
                        {
                          echo "<a href='patient.php?editid=$rs[patientid]' class='btn btn-primary'>Update</a>
                          <a href='patientreport.php?patientid=$rs[patientid]' class='btn btn-success'>View Record</a>";
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php');?>

<?php
if(!empty($_SESSION['success']))
{
?>
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
      </h3>
      <p><?php echo $_SESSION['success']; ?></p>
      <p>
        <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\", 1500);</script>"; ?>
      </p>
    </div>
  </div>
  <?php unset($_SESSION["success"]); ?>
<?php
}

if(!empty($_SESSION['error']))
{
?>
  <div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Error
      </h3>
      <p><?php echo $_SESSION['error']; ?></p>
      <p>
        <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\", 1500);</script>"; ?>
      </p>
    </div>
  </div>
  <?php unset($_SESSION["error"]); ?>
<?php
}
?>

<script>
  var addButtonTrigger = function addButtonTrigger(el) {
    el.addEventListener('click', function () {
      var popupEl = document.querySelector('.' + el.dataset.for);
      popupEl.classList.toggle('popup--visible');
    });
  };

  Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
