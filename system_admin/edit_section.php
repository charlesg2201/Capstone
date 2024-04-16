<?php
// edit_strand.php

// Include the database connection file
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $editsectionId = mysqli_real_escape_string($conn, $_POST["editsectionId"]);
    $editsectionName = mysqli_real_escape_string($conn, $_POST["editsectionName"]);

    // Check if the new section name already exists
    $checkQuery = "SELECT * FROM tbl_section WHERE sections = '$editsectionName' AND id != '$editsectionId'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        // If duplicate, display error message
        echo "<script>alert('Error: Section name already exists!');setTimeout(function() {window.location.href = 'section.php';}, 1500);</script>";
    } else {
        // If not duplicate, perform the update query
        $updateQuery = "UPDATE tbl_section SET sections='$editsectionName' WHERE id='$editsectionId'";
        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            // Set success state
            $_POST['success'] = 1;
        } else {
            // Error message
            echo "Error updating section: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
<!-- Add this JavaScript script to show the success popup -->
<script>
    // Check if the success state is set
    if (<?php echo isset($_POST['success']) ? $_POST['success'] : '0'; ?>) {
        // Display success popup
        alert('Section updated successfully.'); // You can replace this with your custom popup logic
        // Redirect after a delay
        setTimeout(function() {
            window.location.href = 'section.php';
        }, 1500);
    }
</script>
