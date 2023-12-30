<?php
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

    // Display JavaScript confirmation alert
    echo "<script>
            var confirmDelete = confirm('Are you sure you want to delete this section?');
            if (confirmDelete) {
                // Perform the delete operation in the database
                var deleteQuery = 'DELETE FROM tbl_section WHERE id = $deleteId';
                var result = " . json_encode(mysqli_query($conn, $deleteQuery)) . ";

                if (result) {
                    // Display success alert
                    alert('Section deleted successfully.');
                    setTimeout(function() {
                        location.href = 'section.php';
                    }, 1500);
                } else {
                    // Display error alert
                    alert('Error deleting record: ' + " . json_encode(mysqli_error($conn)) . ");
                }
            } else {
                // User cancelled the deletion
                location.href = 'section.php';
            }
          </script>";

    exit();
}
?>