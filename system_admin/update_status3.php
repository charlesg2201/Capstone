<?php
// update_status.php

// Include your database connection file
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the AJAX request
    $academicyearId = $_POST['academicyearId']; // Change variable name from strandId to academicyearId
    $currentStatus = $_POST['currentStatus'];

    // Toggle the delete_status (1 to 0 or 0 to 1)
    $newStatus = $currentStatus == 1 ? 0 : 1;

    // Update the delete_status in the database
    $updateQuery = "UPDATE tbl_academicyear SET delete_status = $newStatus WHERE id = $academicyearId"; // Change variable name from strandId to academicyearId

    if (mysqli_query($conn, $updateQuery)) {
        // Send the new status as a response
        echo $newStatus;
    } else {
        // Handle error if the update fails
        echo "Error updating status: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
