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
   
</head>

<body>
    <?php
    date_default_timezone_set("Asia/Manila");
    require_once('check_login.php');
    include('head.php');
    include('header.php');
    include('sidebar.php');
    include('connect.php');
    ?>

    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-body">
                    <div class="card">
                    <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Health Assessment</h4></div>
                        <div class="card-block">
                            <div class="questions-container">
                                <form method='post' action=''>
                                    <?php
                                    $sql = "SELECT * FROM tbl_health WHERE select_all='0'";
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
                                        echo "</div>";
                                    }
                                    ?>
                                    <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                                </form>
                            </div>

                            <?php
                            if (isset($_POST['submit'])) {
                                for ($i = 1; $i <= $questionNumber; $i++) {
                                    $question_id_key = "question_id_$i";

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

                                        $check_sql = "SELECT * FROM tbl_health_results WHERE question_id = '$question_id' AND lrn_number = '$lrn_number'";
                                        $check_result = mysqli_query($conn, $check_sql);

                                        if (mysqli_num_rows($check_result) > 0) {
                                            $update_sql = "UPDATE tbl_health_results SET answer = '$answer' WHERE question_id = '$question_id' AND lrn_number = '$lrn_number'";
                                            if (!mysqli_query($conn, $update_sql)) {
                                                echo mysqli_error($conn);
                                            }
                                        } else {
                                            $sql = "INSERT INTO tbl_health_results (question_id, answer, lrn_number) VALUES ('$question_id', '$answer', '$lrn_number')";
                                            if ($qsql = mysqli_query($conn, $sql)) {
                                                // Success popup logic
                                                ?>
                                                <div class="popup popup--icon -success js_success-popup popup--visible">
                                                    <div class="popup__background"></div>
                                                    <div class="popup__content">
                                                        <h3 class="popup__content__title">
                                                            Success
                                                        </h3>
                                                        <p>Assessment Have Submitted!</p>
                                                        <p>
                                                            <?php echo "<script>setTimeout(\"location.href = 'health.php';\",1500);</script>"; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php
                                                     } else {
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
    <div class="popup js_already-taken-popup">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h class="popup__content__title">
                Assessment Already Taken
            </h>
            <p>You have already taken the assessment.</p>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
<script>
        $(document).ready(function () {
            <?php
            if (isset($_POST['submit'])) {
            ?>
                $(".js_success-popup").addClass("popup--visible");
                setTimeout(function () {
                    <?php
                    $patientid = $_SESSION['patientid'];
                    $user_query = mysqli_query($conn, "SELECT lrn_number FROM patient WHERE patientid = '$patientid'");
                    $user_data = mysqli_fetch_assoc($user_query);
                    $lrn_number = $user_data['lrn_number'];

                    $check_submission_sql = "SELECT * FROM tbl_health_results WHERE lrn_number = '$lrn_number'";
                    $check_submission_result = mysqli_query($conn, $check_submission_sql);

                    if (mysqli_num_rows($check_submission_result) == 0) {
                        // Redirect only if the assessment hasn't been taken
                        echo "location.href = 'health.php';";
                    }
                    ?>
                }, 1500);
            <?php } ?>
        });

        // Check if the assessment has already been taken
        <?php
        $patientid = $_SESSION['patientid'];
        $user_query = mysqli_query($conn, "SELECT lrn_number FROM patient WHERE patientid = '$patientid'");
        $user_data = mysqli_fetch_assoc($user_query);
        $lrn_number = $user_data['lrn_number'];

        $check_submission_sql = "SELECT * FROM tbl_health_results WHERE lrn_number = '$lrn_number'";
        $check_submission_result = mysqli_query($conn, $check_submission_sql);

        if (mysqli_num_rows($check_submission_result) > 0 && !isset($_POST['submit'])) {
        ?>
            $(document).ready(function () {
                $(".js_already-taken-popup").addClass("popup--visible");
                // Disable form submission if the assessment has already been taken
                $("form").submit(function (e) {
                    e.preventDefault();
                });
            });
        <?php } ?>
    </script>
</html>

