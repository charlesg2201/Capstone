<!-- <?php
$userAnswers = array();

date_default_timezone_set("Asia/Manila");
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

?>

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

                                        $questionKey = "question_$rs[question_id]";
                                        if (!empty($rs['choices'])) {
                                            $choices = explode(",", $rs['choices']);
                                            echo "<div class='choices-container'>";
                                            foreach ($choices as $choice) {
                                                $checked = isset($_POST[$questionKey]) && $_POST[$questionKey] == $choice ? 'checked' : '';
                                                echo "<div class='choice'>
                                                    <input type='radio' name='$questionKey' value='$choice' $checked> $choice
                                                </div>";
                                            }
                                            echo "</div>";
                                        } else {
                                            $answer = isset($_POST[$questionKey]) ? $_POST[$questionKey] : '';
                                            echo "<textarea class='form-control' name='essay_$questionKey' placeholder='Enter your essay response'>$answer</textarea>";
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
                                    $questionKey = "question_$i";
                                    $essayKey = "essay_$questionKey";

                                    if (isset($_POST[$questionKey]) || isset($_POST[$essayKey])) {
                                        $answer = isset($_POST[$questionKey]) ? $_POST[$questionKey] : $_POST[$essayKey];
                                        $userAnswers[$_SESSION['lrn_number']][$questionKey] = $answer;
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

    <div>
        <h2>Selected Answers:</h2>
        <?php
        foreach ($userAnswers as $lrnNumber => $answers) {
            echo "<div><h3>LRN Number: $lrnNumber</h3>";
            echo "<ul>";
            foreach ($answers as $questionKey => $answer) {
                echo "<li><strong>$questionKey:</strong> $answer</li>";
            }
            echo "</ul></div>";
        }
        ?>
    </div>

    <?php include('footer.php'); ?>

</body>

</html> -->
