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
    <title>Student List</title>
    <script type="text/javascript" charset="utf8" src="..\jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="..\jquery.slimscroll.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables/datatables.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables\DataTables-1.13.8\css\dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="..\DataTables\DataTables-1.13.8\js\dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\Datatables\Buttons-2.4.2\css\buttons.dataTables.css">
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.print.js"></script>

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
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Student List</h4></div>
                    <br>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>LRN Number</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th>Strand</th>
                                            <th>Grade Level</th>
                                            <th>Section</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Guardian</th>
                                            <th>Emergency Contact</th>
                                            <th>Address</th>
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
                                                <td>$rs[fname] $rs[mname] $rs[lname]</td>
                                                <td>$rs[contact_number]</td> 
                                                <td>$rs[email]</td> 
                                                <td>$rs[strand]</td> 
                                                <td>$rs[grade_level]</td> 
                                                <td>$rs[section]</td> 
                                                <td>$rs[gender]</td> 
                                                <td>$rs[dob]</td> 
                                                <td>$rs[guardian_name]</td> 
                                                <td>$rs[contact]</td>
                                                <td>$rs[address]</td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php');?>

    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\dataTables.buttons.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.html5.js"></script>
    <script type="text/javascript" charset="utf8" src="..\Datatables\Buttons-2.4.2\js\buttons.print.js"></script>

    <script>
        $(window).on('load', function() {
            // Check if DataTable is already initializedasdsa
            if (!$.fn.DataTable.isDataTable('#dom-jqry')) {
                // If not initialized, initialize DataTable
                $('#dom-jqry').DataTable({
                    "dom": 'Bfrtip',
                    "buttons": [
                        'copy', 'excel', 'pdf', 'print'
                    ]
                });
            }
        });
    </script>
</body>
</html>


