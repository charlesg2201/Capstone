<?php
// save_remarks.php
require_once('connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lrn_number"]) && isset($_POST["remarks"])) {
    $lrn_number = $_POST["lrn_number"];
    $admission_id = $_POST["admission_id"];
    $remarks = $_POST["remarks"];

    // Insert the remarks into your database
    $sql_insert_remarks = "INSERT INTO tbl_health_remarks (lrn_number, admission_id, remarks) VALUES ('$lrn_number', '$admission_id', '$remarks')";
    if ($conn->query($sql_insert_remarks) === TRUE) {
        echo "Remarks saved successfully!";
    } else {
        echo "Error: " . $sql_insert_remarks . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
