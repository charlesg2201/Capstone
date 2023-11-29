<?php
// Include your database connection file here
include('connect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if checkboxes are selected
    if (isset($_POST['record']) && is_array($_POST['record'])) {
        foreach ($_POST['record'] as $selectedId) {
            // Perform an update query for each selected item
            $updateQuery = "UPDATE tbl_physical SET column_to_update = 'new_value' WHERE question_id = $selectedId";
            mysqli_query($conn, $updateQuery);
        }

        // Redirect or display a success message after updating
        header("Location: your_success_page.php");
        exit();
    } 
} else {
    // If the form is not submitted via POST, handle it accordingly
    echo "Invalid request.";
}
?>
