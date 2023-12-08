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
                    <div class="card">
                    <div class="card-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold; margin: 20px 20px 0 20px;"><h1>Health Assessment</h1></div>
                    <br>
                        <div class="card-block">
                            <div class="questions-container">
                                <?php
                                $sql = "SELECT * FROM tbl_Health where select_all='0'";
                                $qsql = mysqli_query($conn, $sql);
                                $questionNumber = 1;

                                while ($rs = mysqli_fetch_array($qsql)) {
                                    echo "<div class='question'>
                                        <strong>Question $questionNumber:</strong> $rs[questions]<br>";

                                    // Check if there are choices
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

                                    echo "</div><br>";
                                    $questionNumber++;
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
