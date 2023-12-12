<?php
// edit_strand.php

// Include the database connection file
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform your database update here using the provided form data
    $editStrandId = $_POST["editStrandId"];
    $editStrandName = $_POST["editStrandName"];

    // Perform the update query (modify this based on your database structure)
    $updateQuery = "UPDATE tbl_strands SET strands='$editStrandName' WHERE id='$editStrandId'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "Strand updated successfully!
        <script>setTimeout(\"location.href = 'strands.php';\", 1500);</script>";
        // You can also return any additional information if needed
    } else {
        echo "Error updating strand: " . mysqli_error($conn);
    }

    // Close the database connection after use
    mysqli_close($conn);
}
?>
