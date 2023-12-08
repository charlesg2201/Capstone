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
                        <div class="card-header"><legend>Physical Assessment Results</legend></div>
                        <div class="card-block">
                        <div class="lrn-number">
                                <?php
                                // Check if 'lrn_number' is set in the URL
                                if (isset($_GET['lrn_number'])) {
                                    $lrn_number = $_GET['lrn_number'];
                                    echo "LRN Number: $lrn_number";
                                } else {
                                    echo "LRN number not provided in the URL.";
                                }
                                ?>
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
                                                echo "Question: " . $row['questions'] . "<br>";
                                                echo "Answer: " . $row['answer'] . "<br>";
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php');?>

</body>

</html>
