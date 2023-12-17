<?php date_default_timezone_set("Asia/Manila"); ?>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
?>
    
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
<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Inbox</h4></div>

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
                     $sql = "SELECT DISTINCT m.patientid, p.lrn_number, CONCAT(p.fname, ' ', p.mname, ' ', p.lname) AS full_name
                     FROM tbl_messages m
                     JOIN patient p ON m.patientid = p.patientid
                     WHERE m.select_all = 0";
             
             $qsql = mysqli_query($conn, $sql);
             
             while ($rs = mysqli_fetch_array($qsql)) {
                 echo "<tr>
                     <td>{$rs['lrn_number']}</td>
                     <td>{$rs['full_name']}</td>
                     <td align='center'>";
              
                  if (isset($_SESSION['userid'])) {
                      echo "<a href='messages.php?patientid={$rs['patientid']}' class='btn btn-success'>View Messages</a>";
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




<script>
  var addButtonTrigger = function addButtonTrigger(el) {
    el.addEventListener('click', function () {
      var popupEl = document.querySelector('.' + el.dataset.for);
      popupEl.classList.toggle('popup--visible');
    });
  };

  Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
