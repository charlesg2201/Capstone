<?php
if (isset($_POST['btn_backup'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "capstone_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $server_info = $conn->server_info;
    $php_version = phpversion();

    $result_db = $conn->query("SELECT DATABASE()");
    $row_db = $result_db->fetch_row();
    $database_name = $row_db[0];

    $filename = $database_name . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
    $file = fopen($filename, 'w');

    fwrite($file, "-- phpMyAdmin SQL Dump\n");
    fwrite($file, "-- version 4.8.5\n");
    fwrite($file, "-- https://www.phpmyadmin.net/\n");
    fwrite($file, "--\n");
    fwrite($file, "-- Host: $servername\n");
    fwrite($file, "-- Generation Time: " . date('M d, Y \a\t h:i A') . "\n");
    fwrite($file, "-- Server version: $server_info\n");
    fwrite($file, "-- PHP Version: $php_version\n");
    fwrite($file, "--\n");

    fwrite($file, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n");
    fwrite($file, "SET AUTOCOMMIT = 0;\n");
    fwrite($file, "START TRANSACTION;\n");
    fwrite($file, "SET time_zone = \"+00:00\";\n\n");

    fwrite($file, "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
    fwrite($file, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
    fwrite($file, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
    fwrite($file, "/*!40101 SET NAMES utf8mb4 */;\n\n");

    $tables = array();
    $result = $conn->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    foreach ($tables as $table) {
        $result_structure = $conn->query("SHOW CREATE TABLE $table");
        $row_structure = $result_structure->fetch_assoc();
        fwrite($file, "--\n-- Table structure for table `$table`\n--\n\n");
        fwrite($file, $row_structure['Create Table'] . ";\n\n");

        $result_data = $conn->query("SELECT * FROM $table");
        if ($result_data->num_rows > 0) {
            fwrite($file, "--\n-- Dumping data for table `$table`\n--\n\n");
            while ($row_data = $result_data->fetch_assoc()) {
                $keys = implode('`, `', array_keys($row_data));
                $values = implode("', '", array_values($row_data));
                fwrite($file, "INSERT INTO `$table` (`$keys`) VALUES ('$values');\n");
            }
            fwrite($file, "\n");
        } else {
            echo "No data found in the table $table.<br>";
        }
    }

    fwrite($file, "COMMIT;\n");
    fwrite($file, "\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
    fwrite($file, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
    fwrite($file, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
    fwrite($file, "/*!40101 SET NAMES utf8mb4 */;\n");

    $conn->close();
    fclose($file);

    $zipFilename = $database_name . '_backup_' . date('Y-m-d_H-i-s') . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFilename, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($filename, basename($filename));
        $zip->close();

        header('Content-Description: File Transfer');
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename=' . basename($zipFilename));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zipFilename));

        readfile($zipFilename);

        unlink($zipFilename);
        unlink($filename);

        exit;
    } else {
        echo "Failed to create the zip file";
    }
}
?>


<!DOCTYPE html>
<title>System Admin</title>
<html lang="en">
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>


 <div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h2>Backup and Restore</h2>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">

</div>
</div>
</div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

        <style>
    .outlined-text {
        display: block;
        background-color: #263238; /* Dark gray background color */
        color: white;
        text-align: left;
        padding: 5px 10px; /* Added left padding */
        margin-left: -10px; /* Added negative margin to compensate for padding */
    }
</style>

<div class="card">
    <div class="card-header">
       
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="border p-3">
                    <h5><span class="outlined-text">Backup</span></h5>
                    <div class="form-group mt-2">
                        <form method="post" action="">
                           <button type="submit" name="btn_backup" class="btn btn-primary">Backup</button>
                         </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="border p-3">
                    <h5><span class="outlined-text">Restore</span></h5>
                    <div class="form-group">
                        <input type="hidden" value="<?=$logo?>" name="old_image">
                        <input type="file" class="form-control mt-2" name="logo">
                        <span class="messages"></span>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>

    </div>
</div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="#">
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>

