<?php
session_start();
$correctPassword = "";
if (isset($_SESSION['password'])) {
    $correctPassword = $_SESSION['password'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn_backup'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "capstone_db";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $inputPassword = isset($_POST['bpassword']) ? $_POST['bpassword'] : "";
        if (!validatePassword($inputPassword, $correctPassword)) {
            echo "<script>alert('Invalid password for backup operation'); window.history.back();</script>";
            die("");
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
            }
        }

        fwrite($file, "COMMIT;\n");
        fwrite($file, "\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
        fwrite($file, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
        fwrite($file, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
        fwrite($file, "/*!40101 SET NAMES utf8mb4 */;\n");

        fclose($file);

        $zipFilename = $database_name. '.zip';
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
            $restoreMessage = "Failed to create the zip file";
        }
        

        $conn->close();

       

    }elseif (isset($_POST['btn_submit'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "capstone_db";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $inputPassword = isset($_POST['rpassword']) ? $_POST['rpassword'] : "";
        if (!validatePassword($inputPassword, $correctPassword)) {
         echo "<script>alert('Invalid password for restore operation'); window.history.back();</script>";
         die("");
        }
      

        if (isset($_FILES['backup_file'])) {
            $backupFile = $_FILES['backup_file']['tmp_name'];

            $zip = new ZipArchive;
            if ($zip->open($backupFile) === TRUE) {
                $extractPath = "./temp_extracted_folder/";

                // Ensure the extraction directory exists
                if (!is_dir($extractPath)) {
                    mkdir($extractPath, 0777, true);
                }

                // Extract the contents of the zip file to the temporary directory
                $zip->extractTo($extractPath);
                $zip->close();

                // Assume the SQL dump is the first file in the extracted directory
                $sqlDumpFile = glob($extractPath . "*.sql")[0];

                if ($sqlDumpFile && is_readable($sqlDumpFile)) {
                    // Read the SQL dump
                    $sql = file_get_contents($sqlDumpFile);

                    // Drop existing tables
                    $tables = $conn->query("SHOW TABLES");
                    while ($row = $tables->fetch_row()) {
                        $table = $row[0];
                        $conn->query("DROP TABLE IF EXISTS $table");
                    }

                    if ($conn->multi_query($sql) === TRUE) {
                        rmdir($extractPath);
                        header("Location: logout.php");
                        unlink($sqlDumpFile);
                    
        $restoreMessage = "Database successfully restored";
        exit;
        // Add additional success actions if needed
    } else {
        $restoreMessage = "Error restoring database";
    }

                    

                    // Clean up extracted files
                    unlink($sqlDumpFile);
                } else {
                    $restoreMessage = "No valid SQL dump found in the zip file.";
                }

                // Remove the temporary extraction directory
                rmdir($extractPath);
            } else {
                $restoreMessage = "Failed to open the zip file";
            }
        }
    }
}
?>

<?php 

function validatePassword($inputPassword, $correctPassword) {
    return $inputPassword === $correctPassword;
}
?>



<!DOCTYPE html>
<title>System Admin</title>
<html lang="en">
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>


<div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold"><h4>Backup and Restore</h4></div>
                        <div class="card-block">

        <style>
    .outlined-text {
        display: block;
        background-color: #0a4b78; /* Dark gray background color */
        color: white;
        text-align: left;
        padding: 5px 10px; /* Added left padding */
        margin-left: -10px; /* Added negative margin to compensate for padding */
    }

      .box-header {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50px; /* Set your desired height */
  background-color: #0a4b78;
  color: white;
  font-weight: bold;
}

.box-header h4 {
  margin: 0;
}                  
</style>

<form method="post" action="" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="border p-3">
                    <h5><span class="outlined-text">Backup</span></h5>
                    <br>
                    <div class="form-group form-primary">
                        <input type="password" name="bpassword" class="form-control" required="" placeholder="Password">
                        <span class="form-bar"></span>
                    </div>
                   
                    <div class="form-group mt-2">
                           <button type="submit" name="btn_backup" class="btn btn-primary">Backup</button>
                    </div>
                </div>
            </div>
</form>

<div class="col-lg-6">
        <div class="border p-3">
            <h5><span class="outlined-text">Restore</span></h5>
            <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <input type="file" class="form-control mt-2" name="backup_file" accept=".zip" required="">
        <span class="messages"></span>
    </div>
     <div class="form-group form-primary">
                        <input type="password" name="rpassword" class="form-control" required="" placeholder="Password">
                        <span class="form-bar"></span>
                    </div>
                    <div class="form-group form-primary">
                        <p>Note: Once you upload you will be automatically logout.</p>
                    </div>
    <div class="form-group mt-2">
        <button type="submit" name="btn_submit" class="btn btn-primary">Upload</button>
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

<div id="#">
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>
<script>
// Use JavaScript to display the restore message
document.addEventListener("DOMContentLoaded", function() {
    var restoreMessage = <?php echo json_encode($restoreMessage); ?>;
    
    if (restoreMessage !== "") {
        alert(restoreMessage); // You can customize this to display the message in a modal or another way
    }
});
</script>