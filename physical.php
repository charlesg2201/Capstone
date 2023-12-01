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
                        <div class="card-header"><h1>Physical Assessment</h1></div>
                        <div class="card-block">
                            <div class="questions-container">
                                <form method='post' action=''>
                                <?php
                                $sql = "SELECT * FROM tbl_physical WHERE select_all='0'";
                                $qsql = mysqli_query($conn, $sql);
                                $questionNumber = 1;
                                
                                while ($rs = mysqli_fetch_array($qsql)) {
                                    echo "<div class='question'>
                                        <strong>Question $questionNumber:</strong> $rs[questions]<br>";
                                
                                    if (!empty($rs['choices'])) {
                                        $choices = explode(",", $rs['choices']);
                                        echo "<div class='choices-container'>";
                                        foreach ($choices as $choice) {
                                            echo "<div class='choice'>
                                                <input type='radio' name='question_$rs[question_id]' value='$choice'> $choice
                                            </div>";
                                        }
                                        echo "</div>";
                                    } else {
                                        echo "<textarea class='form-control' name='essay_question_$rs[question_id]' placeholder='Enter your essay response'></textarea>";
                                    }
                                
                                    echo "<input type='hidden' name='question_id_$questionNumber' value='$rs[question_id]'>";
                                    $questionNumber++;
                                }
                                ?>
                                <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                                </form>
                                </div>
                                
                                <?php
                                if (isset($_POST['submit'])) {
                                    for ($i = 1; $i <= $questionNumber; $i++) {
                                        $question_id_key = "question_id_$i";
                                
                                        // Check if the question_id key is set in the $_POST array and not equal to 0
                                        if (isset($_POST[$question_id_key]) && $_POST[$question_id_key] != 0) {
                                            $question_id = mysqli_real_escape_string($conn, $_POST[$question_id_key]);
                                
                                            if (isset($_POST["question_$question_id"])) {
                                                $answer = mysqli_real_escape_string($conn, $_POST["question_$question_id"]);
                                            } elseif (isset($_POST["essay_question_$question_id"])) {
                                                $answer = mysqli_real_escape_string($conn, $_POST["essay_question_$question_id"]);
                                            } else {
                                                $answer = "";
                                            }
                                
                                            $patientid = $_SESSION['patientid'];
                                            $user_query = mysqli_query($conn, "SELECT lrn_number FROM patient WHERE patientid = '$patientid'");
                                            $user_data = mysqli_fetch_assoc($user_query);
                                            $lrn_number = $user_data['lrn_number'];
                                
                                            $check_sql = "SELECT * FROM tbl_physical_results WHERE question_id = '$question_id' AND lrn_number = '$lrn_number'";
                                            $check_result = mysqli_query($conn, $check_sql);
                                
                                            if (mysqli_num_rows($check_result) > 0) {
                                                $update_sql = "UPDATE tbl_physical_results SET answer = '$answer' WHERE question_id = '$question_id' AND lrn_number = '$lrn_number'";
                                                if ($update_result = mysqli_query($conn, $update_sql)) {
                                                    // Update successful
                                                } else {
                                                    // Update failed
                                                    echo mysqli_error($conn);
                                                }
                                            } else {
                                                $insert_sql = "INSERT INTO tbl_physical_results (question_id, answer, lrn_number) VALUES ('$question_id', '$answer', '$lrn_number')";
                                                if ($insert_result = mysqli_query($conn, $insert_sql)) {
                                                    // Insert successful
                                                } else {
                                                    // Insert failed
                                                    echo mysqli_error($conn);
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                                
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                <?php include('footer.php');?>
                                
                                </body>
                                
                                </html>