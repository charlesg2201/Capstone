<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script type="text/javascript" charset="utf8" src="..\jquery.min.js"></script>
    <!-- jQuery -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="..\DataTables\datatables.min.css">

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="..\DataTables\datatables.min.js"></script>
    
    <!-- DataTables Bootstrap 4 Integration (optional) -->
    <link rel="stylesheet" type="text/css" href="..\DataTables\DataTables-1.13.8\css\dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables\DataTables-1.13.8\js\dataTables.bootstrap4.min.js"></script>

    <!-- Your existing code continues... -->
    <!-- ... -->
</head>
<body>
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
            <div class="card-header"><h1>Student Records</h1></div>
            <div class="card-block">
              <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Strand</th>
                      <th>Grade Level</th>
                      <th>Section</th>
                      <th>Gender</th>
                      <th>Birthdate</th>
                      <th>Gurdian</th>
                      <th>Emergency Contact </th>
                      <th>Address</th>
                      <!--<th></th>-->
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
                          <td>$rs[fname] $rs[lname]<br>
                          <td>$rs[strand]</td> 
                          <td>$rs[grade_level]</td> 
                          <td>$rs[section]</td> 
                          <td>$rs[gender]</td> 
                          <td>$rs[dob]</td> 
                          <td>$rs[guardian_name]</td> 
                          <td>$rs[contact]</td>
                          <td>$rs[address]</td>";
                          //<td align='center'>-->
                       
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
</body>
<script>
    $(document).ready(function() {
        $('#dom-jqry').DataTable();
    });
</script>
