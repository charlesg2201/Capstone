<title>System Admin</title>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_GET['id']))
{
  $sql ="UPDATE tbl_admin_user SET delete_status='1' WHERE userid='$_GET[id]'";
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
            <p>Users record deleted successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'view-user.php';\",1500);</script>"; ?>
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
      <a href="view-user.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-user.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header"><legend>View User</legend></div>
                        <div class="card-block">
<div class="table-responsive dt-responsive">
<table id="dom-jqry" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th>Employee Number</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Contact</th>
    <th>Username</th>
    <th>Gender</th>
    <th>Address</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
  $sql ="SELECT * FROM tbl_admin_user where delete_status='0'";
  $qsql = mysqli_query($conn,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {

    $sqldept = "SELECT * FROM tbl_admin_user WHERE userid='$rs[userid]'";
    $qsqldept = mysqli_query($conn,$sqldept);
    $rsdept = mysqli_fetch_array($qsqldept);
    echo "<tr>
    <td>&nbsp;$rs[employee_number]</td>
    <td>&nbsp;$rs[firstname]</td>
    <td>&nbsp;$rs[lastname]</td>
    <td>&nbsp;$rs[contact]</td>
    <td>&nbsp;$rs[username]</td>
    <td>&nbsp;$rs[gender]</td>
    <td>&nbsp;$rs[address]</td>
    <td>$rs[status]</td>
    <td>&nbsp;
    <a href='users.php?editid=$rs[userid]' class='btn btn-primary'>Update</a></td>
    </tr>";
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

<div id="#">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view-user.php';\",1500);</script>"; ?>
      <!-- <button class="button button--success" data-for="js_success-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view-user.php';\",1500);</script>"; ?>
     <!--  <button class="button button--error" data-for="js_error-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
