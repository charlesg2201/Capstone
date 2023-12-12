<?php
// edit_strand.php

// Include the database connection file
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform your database update here using the provided form data
    $editsectionId = $_POST["editsectionId"];
    $editsectionName = $_POST["editsectionName"];

    // Perform the update query (modify this based on your database structure)
    $updateQuery = "UPDATE tbl_section SET sections='$editsectionName' WHERE id='$editsectionId'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "section updated successfully!
        <script>setTimeout(\"location.href = 'section.php';\", 1500);</script>";
        // You can also return any additional information if needed
    } else {
        echo "Error updating section: " . mysqli_error($conn);
    }

    // Close the database connection after use
    mysqli_close($conn);
}
?>
