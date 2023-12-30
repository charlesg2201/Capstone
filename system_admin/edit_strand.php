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
        // Set success state
        $_POST['success'] = 1;
    } else {
        // Error message
        echo "Error adding strand: " . mysqli_error($conn);
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
        alert('Strand updated successfully.'); // You can replace this with your custom popup logic
        // Redirect after a delay
        setTimeout(function() {
            window.location.href = 'strands.php';
        }, 1500);
    }
</script>
