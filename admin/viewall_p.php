<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

       

        .question {
    margin-bottom: 20px;
    padding: 10px;
    font-size: 18px; /* Adjust this value to increase or decrease the font size of the questions */
}

        .question strong {
            display: bold;
            margin-bottom: 10px;
        }

        
        .choice {
            margin-bottom: 10px;
            margin-right: 30px;
            font-size: 16px;
        }

        .question textarea {
    width: 100%;
    height: 70px;
    padding: 5px;
    box-sizing: border-box;
    margin-top: 20px !important; /* Added !important to ensure the margin takes effect */
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
                    <div class="card-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold; margin: 20px 20px 0 20px;"><h1>Physical Assessment</h1></div>
                        <br>
                        <div class="card-block">
                            <div class="questions-container">
                                <?php
                                $sql = "SELECT * FROM tbl_physical where select_all='0'";
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

                                    echo "</div>";
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
