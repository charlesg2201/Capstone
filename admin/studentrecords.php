<!DOCTYPE html>
<html lang="en">


<?php date_default_timezone_set("Asia/Manila"); ?>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>

<style>
    @media print {
            /* Hide header */
            head, sidebar{
                display: none;
            }
            .print-only {
                    display: block !important;
                    }
            
        }
        @media screen {
                .print-only {
                display: none;
                }
            }
        
    .box-header {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        background-color: #0a4b78;
        color: white;
        font-weight: bold;
    }

    .box-header h4 {
        margin: 0;
    }


    .content-container {
        margin: 0;
        padding: 0;
    }
</style>

<?php
    $sqlpatient = "SELECT * FROM patient";
    $qsqlpatient = mysqli_query($conn, $sqlpatient);
?>


<div class="pcoded-content">
    <div class="box-header">
        <h4>Student Records</h4>
    </div>
    <div>
        <!-- <form action="/search" method="get"> -->
            <!-- <input type="text" name="search" placeholder="Search..."> -->
            <select id="categorySelect" name="category">
                <option value="all">All</option>
                <option value="studentinfo">Student Information</option>
                <option value="admissionrecord">Admission Record</option>
                <option value="category3">Category 3</option>
            </select>
            <!-- <button type="submit">Search</button> -->
            <button onclick="printContent()">Print</button>
        </form>
    </div>

    <div id="studentinformation" style="display: none;">
<?php while ($rspatient = mysqli_fetch_array($qsqlpatient)) { ?>
    <div class="pcoded-inner-content">
    <div id="printable-content">
        <div class="main-body">
            <div class="page-body">
            
            <div class="card" style=" margin: auto; margin-bottom: 20px; ">
            
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

                        <div class="print-only" style="text-align: center; color: #0a4b78; font-weight: bold;"><h4><strong> S T U D E N T &nbsp; R E C O R D </strong></h4></div>
                        <br>
                    <div class="card-block">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <tr>
                                        <th>LRN Number :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['lrn_number']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>First Name :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['fname']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['lname']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Middle Name :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['mname']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number:</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['contact_number']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Email Address :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['email']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth:</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['dob']; ?>" readonly></td>
                                    </tr>
                               
                                    <tr>
                                        <th>Gender :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['gender']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Strand :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['strand']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Grade Level:</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['grade_level']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Section :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['section']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Address :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['address']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Guardian :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['guardian_name']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Guardian's Contact Number :</th>
                                        <td><input type="text" class="form-control" value="<?php echo $rspatient['contact']; ?>" readonly></td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                                <br>
                                <br>
                        <p class="print-only" style="color: #0a4b78";><strong>Printed by: </strong></p>

                            </div>
                        </div>
                    </div>
                </div>
</div>

             
              
              </div>
                        </div>
                        </div>
                        <?php } ?>

</div>


    <div id="admrecord" style="display: none;">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                    <div id="printable-content">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-pane" id="appointment" role="tabpanel">
                                        <p class="m-0">
                                            <div class="table-responsive dt-responsive">
                                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>LRN Number</th>
                                                            <th>Name</th>
                                                            <th>Grade Level</th>
                                                            <th>Section</th>
                                                            <th>Admission Date</th>
                                                            <th>Admission Time</th>
                                                            <th>Reason</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
    // Always fetch admission records regardless of delete_status value
    $sql = "SELECT a.lrn_number, CONCAT(a.fname, ' ', a.lname) AS full_name, a.grade_level, a.section, b.admission_date, b.admission_time, b.reasons, b.remarks
            FROM patient a
            INNER JOIN tbl_admission b ON a.patientid = b.patientid";
    
    $qsql = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($qsql) {
        while ($rs = mysqli_fetch_array($qsql)) {
            echo "<tr>
                    <td>{$rs['lrn_number']}</td>
                    <td>{$rs['full_name']}</td>
                    <td>{$rs['grade_level']}</td>
                    <td>{$rs['section']}</td>
                    <td>{$rs['admission_date']}</td>
                    <td>{$rs['admission_time']}</td>
                    <td>{$rs['reasons']}</td>
                    <td>{$rs['remarks']}</td>
                </tr>";
        }
    } else {
        // Display error message if query fails
        echo "Error fetching admission records: " . mysqli_error($conn);
    }
?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr></tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </p>
                                    </div>
                                    <div id="#"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="category3Content" style="display: none;">
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
        <div id="printable-content" class="content-container">
                <div class="main-body">
                    <div class="page-body">
                        <?php
                        // Fetch all students and their assessment results including reasons from your database
                        $sql_students_results = "SELECT p.lrn_number, p.fname, p.mname, p.lname, p.grade_level, p.section, pr.admission_id, pr.answer, pr.reasons, h.questions
                                                FROM patient p
                                                INNER JOIN tbl_health_results pr ON p.lrn_number = pr.lrn_number
                                                INNER JOIN tbl_health h ON pr.question_id = h.question_id";
                        $result_students_results = $conn->query($sql_students_results);

                        if ($result_students_results->num_rows > 0) {
                            $current_admission_id = null;
                            while ($row = $result_students_results->fetch_assoc()) {
                                // Start a new page for each admission ID
                                if ($row['admission_id'] !== $current_admission_id) {
                                    if ($current_admission_id !== null) {
                                        // Close the previous page
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }

                                    // Start a new page
                                    echo "<div class='card' >";
                                    echo "<div class='card-block' >";

                                    echo "<div class='lrn-number'>";
                                    echo "<b>LRN Number:</b> " . $row['lrn_number'] . "<br>";
                                    echo "<b>Name:</b> " . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . "<br>";
                                    echo "<b>Grade & Section:</b> " . $row['grade_level'] . " & " . $row['section'] . "<br>";
                                    echo "<hr>";

                                    $current_admission_id = $row['admission_id'];
                                }

                                // Print assessment results
                                echo "<b>Question:</b> " . $row['questions'] . "<br>";
                                echo "<b>Answer:</b> " . $row['answer'] . "<br>";
                                echo "<b>Reason:</b> " . $row['reasons'] . "<br>";
                                echo "<br>";
                            }

                            // Close the last page
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "No students found in the database.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<script>
    document.getElementById('categorySelect').addEventListener('change', function() {
        var selectedCategory = this.value;
        
        document.getElementById('studentinformation').style.display = 'none';
        document.getElementById('admrecord').style.display = 'none';
        document.getElementById('category3Content').style.display = 'none';
        
        if (selectedCategory === 'studentinfo') {
            document.getElementById('studentinformation').style.display = 'block';
        } else if (selectedCategory === 'admissionrecord') {
            document.getElementById('admrecord').style.display = 'block';
        } else if (selectedCategory === 'category3') {
            document.getElementById('category3Content').style.display = 'block';
        }
    });

    function printContent() {
            var printWindow = window.open('https://example.com', 'myWindow');
            // Include the styles for the print preview
            printWindow.document.write('<style>body{font-family:Arial,sans-serif;margin:20px;}#printable-content{/* Add your specific styles for the content you want to print */}');
            // Add style to hide buttons in print preview
            printWindow.document.write('.no-print{display:none;}</style>');
            printWindow.document.write('</head><body>');

            // Copy the content you want to print
            printWindow.document.write('<div id="page1" class="printable-content">');
            printWindow.document.write(document.getElementById('studentinformation').innerHTML);
            printWindow.document.write('</div>');

            // Print the second page
            // printWindow.document.write('<div id="page2" class="printable-content">');
            // printWindow.document.write(document.getElementById('admrecord').innerHTML);
            // printWindow.document.write('</div>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    
</script>

<?php include('footer.php'); ?>

</html>
