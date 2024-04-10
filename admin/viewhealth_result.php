<!DOCTYPE html>
    <html lang="en">

    <head>
        <style>
            .question {
                margin-bottom: 20px;
            }

            .choices-container {
                display: flex;
            }

            .choice {
                margin-right: 20px;
            }

            .lrn-number {
                font-size: 18px;
            }
            .box-header {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px; /* Set your desired height */
            color: white;
            font-weight: bold;
            }

            .box-header h4 {
            margin: 0;
            }        
            button {
                padding: 10px;
                font-size: 16px;
                cursor: pointer;
                background-color: #0a4b78; 
                color: white;
                border: none;
                border-radius: 4px;
                display: inline-block;
            }

            button:hover {
                background-color: #45a049; /* Darker color on hover */
            }

            .print-icon::before {
                content: '\1F5B6'; /* Unicode character for printer icon */
                font-size: 20px;
                margin-right: 5px;
            }

          

            @media print {

                .no-print {
                    display: none !important; /* Hide elements with class no-print when printing */
                }
               
                /* Hide elements you don't want to print */
                head, sidebar {
                    display: none;
                }  
                
                .print-only {
                    display: block !important;
                    }
            }

            @media screen {
                .no-print {
                    display: inline-block !important; /* Show elements with class no-print on screen */
                }
                .print-only {
                    display: none !important; /* Hide elements with class print-only on screen */
                }
            }
        </style>
    </head>

    <body>
        <?php date_default_timezone_set("Asia/Manila"); ?>
        <?php require_once('check_login.php');?>
        <?php include('head.php');?>
        <?php include('header.php');?>
        <?php include('sidebar.php');?>
        <?php include('connect.php');?>

        

        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-body">
                        <div class="card">
                        <div id="printable-content">
                        <div class="print-only" style="text-align: center;">
                            <img src="uploadImage/Logo/Seal_of_Tagaytay_City.svg.png" style="width: 10%; margin-top: 20px; border-radius: 20%; float: left;">
                            <img src="uploadImage/Logo/shslogo.png" style="width: 10%; margin-top: 20px; border-radius: 20%; float: right;">
                            <p style="display: inline-block; color: #0a4b78">
                                <strong>City of Tagaytay <br>
                                CITY COLLEGE OF TAGAYTAY <br>
                                Akle St., Kaybagal South, Tagaytay City <br>
                                Telephone No: (046) 482-6840</strong>
                            </p>
                        </div>


                    

                        <div class="box-header" style="text-align: center; color: #0a4b78; font-weight: bold;"><h4><strong> H E A L T H &nbsp; A S S E S S M E N T &nbsp;  R E S U L T S</strong></h4></div>
                        <br>
                        
                            <div class="card-block">
                            <div class="lrn-number">
                            <?php
if (isset($_GET['lrn_number']) && isset($_GET['admission_id'])) {
    $lrn_number = $_GET['lrn_number'];
    $admission_id = $_GET['admission_id'];

    // Fetch the student's information from your database
    // Adjust the query according to your database structure
    $sql_student_info = "SELECT fname, mname, lname, grade_level, section FROM patient WHERE lrn_number = $lrn_number";
    $result_student_info = $conn->query($sql_student_info);

    if ($result_student_info->num_rows > 0) {
        $row_student_info = $result_student_info->fetch_assoc();
        $fname = $row_student_info['fname'];
        $mname = $row_student_info['mname'];
        $lname = $row_student_info['lname'];
        $grade_level = $row_student_info['grade_level'];
        $section = $row_student_info['section'];

        $sql_reasons = "SELECT reasons FROM tbl_admission WHERE lrn_number = $lrn_number AND admission_id = $admission_id";
        $result_reasons = $conn->query($sql_reasons);
        if ($result_reasons->num_rows > 0) {
            $row_reason = $result_reasons->fetch_assoc(); // Assuming only one reason per admission
            echo '<div class="no-print">';
            echo "<b style='color: #0a4b78';>LRN Number:</b> $lrn_number<br>";
            echo "<b style='color: #0a4b78';>Name:</b> $fname $mname $lname<br>";
            echo "<b style='color: #0a4b78';>Grade & Section:</b> $grade_level & $section<br>";
            echo "<b style='color: #0a4b78';>Reason: </b>" . $row_reason['reasons'] . "<br>";
            echo '</div>';
        } else {
            echo "<div>No reasons found for admission.</div>";
        }

    } else {
        echo "Student information not found for the provided LRN number.";
    }
} else {
    echo "LRN number or admission ID not provided in the URL.";
}
?>

<div class="print-only" style="border: 1px solid #0a4b78; padding: 10px; margin-bottom: 10px;">
    <b style='color: #0a4b78;'>LRN Number:</b> <?php echo $lrn_number; ?><br>
    <b style='color: #0a4b78;'>Name:</b> <?php echo "$fname $mname $lname"; ?><br>
    <b style='color: #0a4b78;'>Grade & Section:</b> <?php echo "$grade_level & $section"; ?><br>
    <b style='color: #0a4b78;'>Reason: </b><?php echo $row_reason['reasons']; ?><br>
</div>

</div>

    <hr>
                                </div>
                                <div class="card-block">
        <div class="questions-container">
            <?php
            
            // Check if 'lrn_number' is set in the URL
            if (isset($_GET['admission_id'])) {
                $admission_id = $_GET['admission_id'];

                // Fetch questions and answers from tbl_health_results based on lrn_number
                $sql = "SELECT hr.*, p.questions
                        FROM tbl_health_results hr
                        JOIN tbl_health p ON hr.question_id = p.question_id
                        WHERE hr.admission_id = $admission_id";

                $result = $conn->query($sql);
                echo '<div class="no-print">'; // Opening the container div
                if ($result) { // Check if the query was successful
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<b style='color: #0a4b78';>Question: </b>" . $row['questions'] . "<br>";
                            echo "<b style='color: #0a4b78';>Answer: </b>" . $row['answer'] . "<br>";
                            echo "<br>";
                        }
                    } else {
                        echo "No questions found for the provided LRN number.<br>";
                    }
                } else {
                    echo "Error in the SQL query: " . $conn->error;
                }
            } else {
                echo "LRN number not provided in the URL.";
            }
            echo '</div>'; // Closing the container div
            ?>

            <div class="print-only">
                <?php
                // Check if 'lrn_number' is set in the URL
                if (isset($_GET['admission_id'])) {
                    $admission_id = $_GET['admission_id'];

                    // Fetch questions and answers from tbl_health_results based on lrn_number
                    $sql = "SELECT pr.*, p.questions
                            FROM tbl_health_results pr
                            JOIN tbl_health p ON pr.question_id = p.question_id
                            WHERE pr.admission_id = $admission_id";

                    $result = $conn->query($sql);
                    echo '<div style="border: 1px solid #0a4b78; padding: 10px; margin-bottom: 10px;">'; // Opening the container div
                    if ($result) { // Check if the query was successful
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<b style='color: #0a4b78';>Question: </b>" . $row['questions'] . "<br>";
                                echo "<b style='color: #0a4b78';>Answer: </b>" . $row['answer'] . "<br>";
                                echo "<br>";
                            }
                        } else {
                            echo "No questions found for the provided LRN number.<br>";
                        }
                    } else {
                        echo "Error in the SQL query: " . $conn->error;
                    }
                    echo '</div>'; // Closing the container div
                } else {
                    echo "LRN number not provided in the URL.";
                }
                ?>
            </div>


        </div>
        <?php 
    $sql_remarks = "SELECT remarks FROM tbl_health_remarks WHERE lrn_number = $lrn_number AND admission_id = $admission_id";
    $result_remarks = $conn->query($sql_remarks);

    echo '<div class="no-print">';
    if ($result_remarks) {
        if ($result_remarks->num_rows > 0) {
            echo "<div><b style='color: #0a4b78';>Remarks:</b></div>";
            while ($row_remarks = $result_remarks->fetch_assoc()) {
                echo "<p>" . $row_remarks['remarks'] . "</p>";
            }
        } else {
            echo "<div>No remarks available.</div>";
        }
    } else {
        echo "Error in the SQL query: " . $conn->error;
    }
    echo '</div>'; // Closing the container div
    ?>

    <div class="print-only" style="border: 1px solid #0a4b78; padding: 10px; margin-bottom: 10px";>
        <?php
        $sql_remarks = "SELECT remarks FROM tbl_health_remarks WHERE lrn_number = $lrn_number AND admission_id = $admission_id";
        $result_remarks = $conn->query($sql_remarks);

        if ($result_remarks) {
            if ($result_remarks->num_rows > 0) {
                echo "<div><b style='color: #0a4b78';>Remarks:</b></div>";
                while ($row_remarks = $result_remarks->fetch_assoc()) {
                    echo "<p>" . $row_remarks['remarks'] . "</p>";
                }
            } else {
                echo "<div>No remarks available.</div>";
            }
        } else {
            echo "Error in the SQL query: " . $conn->error;
        }
        ?>
    </div>

    <?php
$firstname = ""; // Initialize the variables to avoid "undefined variable" notices
$lastname = "";

if(isset($_SESSION['firstname'])) {
    $firstname = $_SESSION['firstname'];
}

if(isset($_SESSION['lastname'])) {
    $lastname = $_SESSION['lastname'];
}



?>

<p class="print-only" style="color: #0a4b78;"><strong>Printed by: <?php echo $firstname . ' ' . $lastname; ?></strong></p>

</div>
    <div class="form-group row">
            <label class="col-sm-1"></label>
            <div class="col-sm-10">
    <button onclick="printContent()" class="no-print">Print</button>
    <button onclick="showRemarksModal()" class="no-print">Add Remarks</button>
    </div>
        </div>


    <script>
        function showRemarksModal() {
        var remarks = prompt("Enter your remarks:");
        if (remarks !== null) {
            // Send the remarks to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Remarks submitted successfully!");
                    location.reload();
                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                    alert("Error submitting remarks. Please try again.");
                }
            };
            xhr.open("POST", "health_remarks.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("lrn_number=<?php echo $lrn_number; ?>&admission_id=<?php echo $admission_id; ?>&remarks=" + encodeURIComponent(remarks));
        }
    }


        function printContent() {
            var printWindow = window.open('https://example.com', 'myWindow');
            // Include the styles for the print preview
            printWindow.document.write('<style>body{font-family:Arial,sans-serif;margin:20px;}#printable-content{/* Add your specific styles for the content you want to print */}');
            // Add style to hide buttons in print preview
            printWindow.document.write('.no-print{display:none;}</style>');
            printWindow.document.write('</head><body>');

            // Copy the content you want to print
            var contentToPrint = document.getElementById('printable-content').innerHTML;
            printWindow.document.write(contentToPrint);

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

        </div>
        

    

        <?php include('footer.php');?>

    </body>

    </html>
