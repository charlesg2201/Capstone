<?php
    // Connect to the database (you may need to update this part)
    require_once('connect.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize the input
        $sectionName = mysqli_real_escape_string($conn, $_POST['sectionName']);

        // Check if the section already exists
        $checkQuery = "SELECT * FROM tbl_section WHERE sections = '$sectionName'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            // Error message
            echo "<script>alert('Error: Section already exists!');setTimeout(function() {window.location.href = 'section.php';}, 1500);</script>";
        } else {
            // Insert the section into the database
            $sql = "INSERT INTO tbl_section (sections) VALUES ('$sectionName')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Set success state
                $_POST['success'] = 1;
            } else {
                // Error message
                echo "Error adding section: " . mysqli_error($conn);
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
        alert('Section added successfully.'); // You can replace this with your custom popup logic
        // Redirect after a delay
        setTimeout(function() {
            window.location.href = 'section.php';
        }, 1500);
    }
</script>
