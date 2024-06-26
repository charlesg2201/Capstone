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
<title>System Admin</title>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
// Deactivation logic
if (isset($_GET['id'])) {
  $user_id = $_GET['id'];
  $sql = "UPDATE tbl_admin_user SET delete_status = CASE WHEN delete_status = 0 THEN 1 ELSE 0 END WHERE userid='$user_id'";
  $qsql = mysqli_query($conn, $sql);
  if (mysqli_affected_rows($conn) == 1) {
      // Deactivation success message and redirect
      echo "<script>setTimeout(\"location.href = 'view-user.php';\",1500);</script>";
  }
}

// Display button text based on user's status
function getButtonText($delete_status) {
  return $delete_status ? 'Activate' : 'Deactivate';
}

?>
<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>View Users</h4></div>
                        <div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">
    
<br>  
<div class="table-responsive dt-responsive">
<table id="dom-jqry" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Last Name</th>
    <th>Contact</th>
    <th>Gender</th>
    <th>Address</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
// ...

// Display text for the Status column
function getStatusText($delete_status) {
    return $delete_status ? 'Not Active' : 'Active';
}

// Determine button class based on status
function getButtonClass($delete_status) {
    return $delete_status ? 'btn btn-success' : 'btn btn-danger';
}

// Ensure that $qsql is initialized before using it
$qsql = mysqli_query($conn, "SELECT * FROM tbl_admin_user");

if ($qsql) {
    while ($rs = mysqli_fetch_array($qsql)) {
        $buttonText = getButtonText($rs['delete_status']);
        $statusText = getStatusText($rs['delete_status']);
        $buttonClass = getButtonClass($rs['delete_status']);

        echo "<tr>
                <td>&nbsp;$rs[firstname]</td>
                <td>&nbsp;$rs[middlename]</td>
                <td>&nbsp;$rs[lastname]</td>
                <td>&nbsp;$rs[contact]</td>
                <td>&nbsp;$rs[gender]</td>
                <td>&nbsp;$rs[address]</td>
                <td>&nbsp;$statusText</td>
                <td>&nbsp;
                    <a href='update.php?editid=$rs[userid]' class='btn btn-primary'>Update</a>
                    <a href='view-user.php?id=$rs[userid]' class='$buttonClass'>$buttonText</a>
                </td>
            </tr>";
    }
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// ...
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
<?php if (!empty($_SESSION['success'])) { ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h1>
        <p><?php echo $_SESSION['success']; ?></p>
        <p>
            <?php echo "<script>setTimeout(\"location.href = 'view-user-sa.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php unset($_SESSION["success"]); } ?>
<?php if (!empty($_SESSION['error'])) { ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Error
        </h1>
        <p><?php echo $_SESSION['error']; ?></p>
        <p>
            <?php echo "<script>setTimeout(\"location.href = 'view-user-sa.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php unset($_SESSION["error"]); } ?>

<script>
    var addButtonTrigger = function addButtonTrigger(el) {
        el.addEventListener('click', function () {
            var popupEl = document.querySelector('.' + el.dataset.for);
            popupEl.classList.toggle('popup--visible');
        });
    };

    Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
