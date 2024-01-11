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
            /* Hide elements you don't want to print */
            head, sidebar {
                display: none;
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
                    <div class="box-header" style="text-align: center; color: black; font-weight: bold;"><h4>Physical Assessment Results</h4></div>
                    
                        <div class="card-block">
                        <div class="lrn-number">
                        <?php
    if (isset($_GET['lrn_number'])) {
        $lrn_number = $_GET['lrn_number'];

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

            // Now you can display the student's information
            echo "<b>LRN Number:</b> $lrn_number<br>"; 
            echo "<b>Name:</b> $fname $mname $lname<br>";
            echo "<b>Grade & Section:</b> $grade_level & $section";

        } else {
            echo "Student information not found for the provided LRN number.";
        }
    } else {
        echo "LRN number not provided in the URL.";
    }
?>
<hr>
                            </div>
                            <div class="card-block">
    <div class="questions-container">
        <?php
        // Check if 'lrn_number' is set in the URL
        if (isset($_GET['lrn_number'])) {
            $lrn_number = $_GET['lrn_number'];

            // Fetch questions and answers from tbl_physical_results based on lrn_number
            $sql = "SELECT pr.*, p.questions
                    FROM tbl_physical_results pr
                    JOIN tbl_physical p ON pr.question_id = p.question_id
                    WHERE pr.lrn_number = $lrn_number";

            $result = $conn->query($sql);

            if ($result) { // Check if the query was successful
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<b>Question: </b>" . $row['questions'] . "<br>";
                        echo "<b>Answer: </b>" . $row['answer'] . "<br>";
                        echo "<hr>";
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
        ?>
    </div>
</div>
<button onclick="printContent()" class="no-print">Print</button>
<button onclick="redirectToRemarks()" class="no-print">Remarks</button>


<script>
    function redirectToRemarks() {
        // Redirect to remarks.php
        window.location.href = 'remarks.php';
    }

    function printContent() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Report</title>');
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
