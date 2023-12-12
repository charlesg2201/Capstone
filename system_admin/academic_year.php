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
                        <div class="card-header"><legend>Academic Year</legend></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Academic Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM tbl_academicyear where delete_status='0'";
                                            $qsql = mysqli_query($conn, $sql);
                                            while($rs = mysqli_fetch_array($qsql)) {
                                                echo "<tr>
                                                    <td>$rs[academic_year]</td>
                                                    <td align=''>";
                                                   
                                                    if(isset($_SESSION['id'])) {
                                                        echo "
                                                        <a href='#' class='btn btn-success' data-toggle='modal' data-target='#editacademicyearModal' data-id='$rs[id]' data-name='$rs[academic_year]'>Edit</a>";
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
                                        echo "<button id='addAcademicYear' class='btn btn-primary'>Add Academic Year</button>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editacademicyearModal" tabindex="-1" role="dialog" aria-labelledby="editacademicyearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editacademicyearModalLabel">Edit Academic Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <p id="currentacademicyearName" style="font-weight: bold;"></p>
    <form id="editacademicyearForm" method="post" action="edit_academicyear.php">
        <input type="hidden" id="editacademicyearId" name="editacademicyearId">
        <div class="form-group">
            <label for="editacademicyearName">New Academic Year Name:</label>
            <input type="text" class="form-control" id="editacademicyearName" name="editacademicyearName" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
    <!-- Add academicyear Modal -->
    <div class="modal fade" id="addAcademicYeadModal" tabindex="-1" role="dialog" aria-labelledby="addAcademicYeadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAcademicYeadModalLabel">Add Academic Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStrandForm" method="post" action="save_academicyear.php">
                        <div class="form-group">
                            <label for="academicYear">Academic Year:</label>
                            <input type="text" class="form-control" id="academicYear" name="academicYear" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Academic Year</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#addAcademicYear").click(function() {
                $("#addAcademicYeadModal").modal("show");
            });

            $("#editacademicyearModal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var academicyearId = button.data("id");
            var academicyearName = button.data("name");
            var modal = $(this);

            modal.find("#editacademicyearId").val(academicyearId);
            modal.find("#editacademicyearName").val(academicyearName);

            // Display current value in the modal
            modal.find("#currentacademicyearName").text("Current Value: " + academicyearName);
        });
        });
    </script>

    <?php include('footer.php');?>

</body>
</html>
