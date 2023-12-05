<?php
    // Connect to the database (you may need to update this part)
    require_once('connect.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize the input
        $strandName = mysqli_real_escape_string($conn, $_POST['strandName']);

        // Insert the strand into the database
        $sql = "INSERT INTO tbl_strands (strands) VALUES ('$strandName')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Success popup
            echo "<div class='popup popup--icon -success js_success-popup popup--visible'>
                    <div class='popup__background'></div>
                    <div class='popup__content'>
                        <h3 class='popup__content__title'>Success</h3>
                        <p>Strand added successfully.</p>
                        <script>setTimeout(\"location.href = 'strands.php';\", 1500);</script>
                    </div>
                </div>";
        } else {
            // Error message
            echo "Error adding strand: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
?>
