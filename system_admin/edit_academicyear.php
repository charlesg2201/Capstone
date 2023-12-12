<?php
// edit_academicyear.php

// Include the database connection file
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform your database update here using the provided form data
    $editacademicyearId = $_POST["editacademicyearId"];
    $editacademicyearName = $_POST["editacademicyearName"];

    // Perform the update query (modify this based on your database structure)
    $updateQuery = "UPDATE tbl_academicyear SET academic_year='$editacademicyearName' WHERE id='$editacademicyearId'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "Academic Year updated successfully!
        <script>setTimeout(\"location.href = 'academic_year.php';\", 1500);</script>";
        // You can also return any additional information if needed
    } else {
        echo "Error updating academicyear: " . mysqli_error($conn);
    }

    // Close the database connection after use
    mysqli_close($conn);
}
?>
