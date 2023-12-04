<?php
// Include your database connection file here
include('connect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if checkboxes are selected
    if (isset($_POST['record']) && is_array($_POST['record'])) {
        foreach ($_POST['record'] as $selectedId) {
            // Retrieve the existing choices for the selected question ID
            $selectQuery = "SELECT choices FROM tbl_physical WHERE question_id = $selectedId";
            $result = mysqli_query($conn, $selectQuery);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $existingChoices = $row['choices'];

                // Now you can use $existingChoices to display or modify the choices in your form
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "No records selected.";
    }
} else {
    // If the form is not submitted via POST, handle it accordingly
    echo "Invalid request.";
}
?>
