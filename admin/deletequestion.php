<?php
session_start();
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_GET['deleteid'])) {
    $deleteId = $_GET['deleteid'];

    // Perform the delete operation in the database
    $deleteQuery = "DELETE FROM tbl_physical WHERE question_id = $deleteId";
    $result = mysqli_query($conn, $deleteQuery);

    if($result) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Redirect back to the page with the table
header("manage_physical.php"); // Replace "yourpage.php" with the actual filename of your page
exit();
?>
