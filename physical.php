<!DOCTYPE html>
<html lang="en">



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
            <div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">

<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i> Home</a></li>
<li class="breadcrumb-item">Physical Assessment</a></li>

</ul>
</div>
</div>
</div>
</div>
                <div class="page-body">
                    <div class="card">
                        <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Physical Assessment</h4></div>
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
                                                    <input type='radio' name='question_$rs[question_id]' value='$choice' required=''> $choice
                                                </div>";
                                            }
                                            echo "</div>";
                                        } else {
                                            echo "<textarea class='form-control' name='essay_question_$rs[question_id]' placeholder='Enter your essay response'></textarea>";
                                        }
                                    
                                        echo "<input type='hidden' name='question_id_$questionNumber' value='$rs[question_id]'>";
                                        $questionNumber++;
                                        echo "<br>"; // Add a line break between questions
                                    }
                                    ?>
                                    <br>
                                    <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                                    </form>
                                    </div>
                                    

                            <?php
                            if (isset($_POST['submit'])) {
                                $patientid = $_SESSION['patientid'];
                            
                                // Get the latest admission_id for the given LRN number
                                $user_query = mysqli_query($conn, "SELECT MAX(admission_id) as max_admission_id, lrn_number FROM tbl_admission WHERE patientid = '$patientid'");
                                $user_data = mysqli_fetch_assoc($user_query);
                                $lrn_number = $user_data['lrn_number'];
                                $admission_id = $user_data['max_admission_id'];
                            
                                // Check if assessment has already been taken for the current admission
                                $check_sql = "SELECT * FROM tbl_physical_results WHERE lrn_number = '$lrn_number' AND admission_id = '$admission_id'";
                                $check_result = mysqli_query($conn, $check_sql);
                            
                                if (mysqli_num_rows($check_result) > 0) {
                                    // Display a message or perform any action if assessment has already been taken for the current admission
                                    echo '<div class="popup popup--icon -error js_error-popup popup--visible">';
echo '    <div class="popup__background"></div>';
echo '    <div class="popup__content">';
echo '        <h3 class="popup__content__title">';
echo '            Error';
echo '        </h3>';
echo '        <p>Assessment have been already taken for this admission!</p>';
echo '        <p>';
echo "            <script>setTimeout(\"location.href = 'physical.php';\",2500);</script>";
echo '        </p>';
echo '    </div>';
echo '</div>';

                                } else {
                                    // User hasn't taken the assessment for the current admission, proceed with processing the assessment
                            
                                    for ($i = 1; $i <= $questionNumber; $i++) {
                                        $question_id_key = "question_id_$i";
                            
                                        if (isset($_POST[$question_id_key]) && $_POST[$question_id_key] != 0) {
                                            $question_id = mysqli_real_escape_string($conn, $_POST[$question_id_key]);
                                            $answer = '';
                            
                                            if (isset($_POST["question_$question_id"])) {
                                                $answer = mysqli_real_escape_string($conn, $_POST["question_$question_id"]);
                                            } elseif (isset($_POST["essay_question_$question_id"])) {
                                                $answer = mysqli_real_escape_string($conn, $_POST["essay_question_$question_id"]);
                                            }
                            
                                            // Debug: Output question_id, answer, lrn_number, and admission_id for verification
                                            echo "Question ID: $question_id, Answer: $answer, lrn_number: $lrn_number, admission_id: $admission_id<br>";
                            
                                            // Insert the assessment record
                                            $sql = "INSERT INTO tbl_physical_results (question_id, answer, lrn_number, admission_id) VALUES ('$question_id', '$answer', '$lrn_number', '$admission_id')";
                                            if ($qsql = mysqli_query($conn, $sql)) {
                                                // Success popup logic
                                                ?>
                                                <div class="popup popup--icon -success js_success-popup popup--visible">
                                                    <div class="popup__background"></div>
                                                    <div class="popup__content">
                                                        <h3 class="popup__content__title">
                                                            Success
                                                        </h3>
                                                        <p>Assessment have been Submitted!</p>
                                                        <p>
                                                            <?php echo "<script>setTimeout(\"location.href = 'physical.php';\",1500);</script>"; ?>
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

    <!-- Popup for already taken assessment -->
    


    <?php include('footer.php'); ?>
</body>

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
            height: 50px;
            background-color: #0a4b78;
            color: white;
            font-weight: bold;
        }

        .box-header h4 {
            margin: 0;
        }
    </style>

    
    
</head>


</html>