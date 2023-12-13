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
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Sections</h4></div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Sections</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM tbl_section where delete_status='0'";
                                            $qsql = mysqli_query($conn, $sql);
                                            while($rs = mysqli_fetch_array($qsql)) {
                                                echo "<tr>
                                                    <td>$rs[sections]</td>
                                                    <td align=''>";
                                                
                                                if(isset($_SESSION['id'])) {
                                                    echo "
                                                    <a href='#' class='btn btn-success' data-toggle='modal' data-target='#editsectionModal' data-id='$rs[id]' data-name='$rs[sections]'>Edit</a>
                                                        <a href='deletesection.php?deleteid=$rs[id]' class='btn btn-success'>Delete</a>";
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
                                        echo "<button id='addsectionButton' class='btn btn-primary'>Add Section</button>";
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
<div class="modal fade" id="editsectionModal" tabindex="-1" role="dialog" aria-labelledby="editsectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editsectionModalLabel">Edit Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <p id="currentsectionName" style="font-weight: bold;"></p>
    <form id="editsectionForm" method="post" action="edit_section.php">
        <input type="hidden" id="editsectionId" name="editsectionId">
        <div class="form-group">
            <label for="editsectionName">New Section Name:</label>
            <input type="text" class="form-control" id="editsectionName" name="editsectionName" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

        </div>
    </div>
</div>
    <!-- Add Strand Modal -->
    <div class="modal fade" id="addsectionModal" tabindex="-1" role="dialog" aria-labelledby="addsectionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addsectionModalLabel">Add Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addsectionForm" method="post" action="save_section.php">
                        <div class="form-group">
                            <label for="sectionName">Section Name:</label>
                            <input type="text" class="form-control" id="sectionName" name="sectionName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Section</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#addsectionButton").click(function() {
            $("#addsectionModal").modal("show");
        });

        // Edit Strand Modal
        $("#editsectionModal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var sectionId = button.data("id");
            var sectionName = button.data("name");
            var modal = $(this);

            modal.find("#editsectionId").val(sectionId);
            modal.find("#editsectionName").val(sectionName);

            // Display current value in the modal
            modal.find("#currentsectionName").text("Current Value: " + sectionName);
        });
    });
    </script>

    <?php include('footer.php');?>
</body>
</html>
