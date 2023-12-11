<?php
session_start();
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_GET['deleteid'])) {
    $deleteId = $_GET['deleteid'];

    // Perform the delete operation in the databaseasdsadsdsa
    $deleteQuery = "DELETE FROM tbl_section WHERE id = $deleteId";
    $result = mysqli_query($conn, $deleteQuery);

    if($result) {
        
        ?>
                        <div class="popup popup--icon -success js_success-popup popup--visible">
                            <div class="popup__background"></div>
                            <div class="popup__content">
                                <h3 class="popup__content__title">Success</h3>
                                <p>Strand deleted successfully.</p>
                                <?php echo "<script>setTimeout(\"location.href = 'section.php';\",1500);</script>"; ?>
                            </div>
                        </div>
        <?php
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Redirect back to the page with the table

exit();
?>
