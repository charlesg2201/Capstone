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
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Academic Year</h4></div>
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
                                                $buttonText = $rs['delete_status'] ? 'Unarchive' : 'Archive';
                                                $buttonClass = $rs['delete_status'] ? 'btn-success' : 'btn-warning';
                                                echo "<tr>
                                                    <td>$rs[academic_year]</td>
                                                    <td align=''>
                                                
                                               
                                                    <a href='#' class='btn btn-success' data-toggle='modal' data-target='#editacademicyearModal' data-id='$rs[id]' data-name='$rs[academic_year]'>Update</a>
                                                    <button class='btn $buttonClass archive-btn' data-id='$rs[id]' data-status='$rs[delete_status]'>
                                                            $buttonText
                                                        </button>
                                                
                                                </td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                                <?php
                                    if (isset($_SESSION['id'])) {
                                        echo "<button id='addacademicyearButton' class='btn btn-primary'>Add Academic Year</button>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Strand Modal -->
<div class="modal fade" id="editacademicyearModal" tabindex="-1" role="dialog" aria-labelledby="editacademicyearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editacademicyearModalLabel">Update Academic Year</h5>
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

        </div>
    </div>
</div>
    <!-- Add Strand Modal -->
    <div class="modal fade" id="addacademicyearModal" tabindex="-1" role="dialog" aria-labelledby="addacademicyearModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addacademicyearModalLabel">Add Academic Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="addacademicyearForm" method="post" action="save_academicyear.php">
    <div class="form-group">
        <label for="academic_year">Academic Year Name:</label>
        <input type="text" class="form-control" id="academicyearName" name="academic_year" required>
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
        $("#addacademicyearButton").click(function() {
            $("#addacademicyearModal").modal("show");
        });

        // Edit Strand Modal
        $("#editacademicyearModal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var academicyearId = button.data("id");
            var academicyearName = button.data("name");
            var modal = $(this);

            modal.find("#editacademicyearId").val(academicyearId);
            modal.find("#editacademicyearName").val(academicyearName);

            // Display current value in the modal
            modal.find("#currentacademicyearName").text("Academic Year: " + academicyearName);
        });
    });

    $(".archive-btn").click(function() {
            var academicyearId = $(this).data("id"); // Change variable name from strandId to academicyearId
            var currentStatus = $(this).data("status");

            // Send an AJAX request to update the delete_status in the database
            $.ajax({
                url: "update_status3.php", // replace with your server-side script for updating status
                method: "POST",
                data: {
                    academicyearId: academicyearId, // Change variable name from strandId to academicyearId
                    currentStatus: currentStatus
                },
                success: function(response) {
                    // Update button text and class based on the new status
                    var buttonText = response == 1 ? 'Unarchive' : 'Archive';
                    var buttonClass = response == 1 ? 'btn-success' : 'btn-warning';

                    // Update button text and class
                    $(".archive-btn[data-id='" + academicyearId + "']")
                        .text(buttonText)
                        .removeClass('btn-success btn-warning')
                        .addClass(buttonClass);

                    // Update data-status attribute
                    $(".archive-btn[data-id='" + academicyearId + "']").data("status", response);
                },
                error: function(xhr, status, error) {
                    console.error("Error updating status:", error);
                }
            });
        });
</script>

    

    <?php include('footer.php');?>
