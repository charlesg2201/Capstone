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
                        <div class="card-header"><h1>Strands</h1></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Strands</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM tbl_strands where delete_status='0'";
                                            $qsql = mysqli_query($conn, $sql);
                                            while($rs = mysqli_fetch_array($qsql)) {
                                                echo "<tr>
                                                    <td>$rs[strands]</td>
                                                    <td align=''>";
                                                
                                                if(isset($_SESSION['id'])) {
                                                    echo "
                                                        <a href='deletestrand.php?deleteid=$rs[id]' class='btn btn-success'>Delete</a>";
                                                }
                                                
                                                echo "</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                                <?php
                                    if (isset($_SESSION['id'])) {
                                        echo "<button id='addStrandButton' class='btn btn-primary'>Add Strand</button>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Strand Modal -->
    <div class="modal fade" id="addStrandModal" tabindex="-1" role="dialog" aria-labelledby="addStrandModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStrandModalLabel">Add Strand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStrandForm" method="post" action="save_strand.php">
                        <div class="form-group">
                            <label for="strandName">Strand Name:</label>
                            <input type="text" class="form-control" id="strandName" name="strandName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Strand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#addStrandButton").click(function() {
                $("#addStrandModal").modal("show");
            });
        });
    </script>

    <?php include('footer.php');?>

</body>
</html>
