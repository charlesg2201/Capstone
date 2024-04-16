<?php
    // Connect to the database (you may need to update this part)
    require_once('connect.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize the input
        $academicYear = mysqli_real_escape_string($conn, $_POST['academic_year']);

        // Check if the academic year already exists
        $checkQuery = "SELECT * FROM tbl_academicyear WHERE academic_year = '$academicYear'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            // Error message
            echo "<script>alert('Error: Academic Year already exists!');setTimeout(function() {window.location.href = 'academic_year.php';}, 1500);</script>";
        } else {
            // Insert the academic year into the database
            $sql = "INSERT INTO tbl_academicyear (academic_year) VALUES ('$academicYear')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Set success state
                $_POST['success'] = 1;
            } else {
                // Error message
                echo "Error adding academic year: " . mysqli_error($conn);
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
        alert('Academic Year added successfully.'); // You can replace this with your custom popup logic
        // Redirect after a delay
        setTimeout(function() {
            window.location.href = 'academic_year.php';
        }, 1500);
    }
</script>
