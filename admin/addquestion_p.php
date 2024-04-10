<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

// Check if the edit button is clicked
if (isset($_GET['editid'])) {
    $editId = $_GET['editid'];

    // Retrieve the existing choices for the selected question ID
    $selectQuery = "SELECT questions, question_type, choices FROM tbl_physical WHERE question_id = $editId";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $existingQuestions = $row['questions'];
        $existingQuestionType = $row['question_type'];
        $existingChoices = $row['choices'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Rest of your existing PHP code...

if (isset($_POST['btn_submit'])) {
    $questions = $_POST['questions'];
    $question_type = $_POST['question_type'];

    if (isset($_POST['choices']) && is_array($_POST['choices'])) {
        $choices = implode(', ', $_POST['choices']);
    } else {
        $choices = '';
    }

    if (isset($_GET['editid'])) {
        $sql = "UPDATE tbl_physical SET questions='$questions', question_type='$question_type', choices='$choices' WHERE question_id='$editId'";
        if ($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                    <h3 class="popup__content__title">Success</h3>
                    <p>Updated Successfully</p>
                    <?php echo "<script>setTimeout(\"location.href = 'manage_physical.php';\",1500);</script>"; ?>
                </div>
            </div>
<?php
        } else {
            echo mysqli_error($conn);
        }
    } else {
        $sql = "INSERT INTO tbl_physical (questions, question_type, choices) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $questions, $question_type, $choices);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
?>
                <div class="popup popup--icon -success js_success-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">Success</h3>
                        <p>Question added successfully</p>
                        <?php echo "<script>setTimeout(\"location.href = 'manage_physical.php';\",1500);</script>"; ?>
                    </div>
                </div>
<?php
            } else {
                echo mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo mysqli_error($conn);
        }
    }
}

// Rest of your existing PHP code...

?>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<style>
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
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-body">
                <div class="card">
                <div class="box-header" style="text-align: center; background-color: #0a4b78; color: white; font-weight: bold;"><h4>Physical Assessment</h4></div>
                    <div class="card-block">
                        <hr>
                        <form id="main" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Question</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="questions" id="questions" placeholder="Enter a Question" required=""><?php echo isset($existingQuestions) ? $existingQuestions : ''; ?></textarea>
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Question Type</label>
                                <div class="col-sm-4">
                                    <select class="form-control show-tick" name="question_type" id="question_type" required="">
                                        <option value="">--Select one--</option>
                                        <?php
                                        $arr = array("Multiple Choice", "Essay");
                                        foreach ($arr as $val) {
                                            if ($val == $existingQuestionType) {
                                                echo "<option value='$val' selected>$val</option>";
                                            } else {
                                                echo "<option value='$val'>$val</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <div class="form-group row" id="choicesContainer" style="display: <?php echo (isset($existingQuestionType) && $existingQuestionType == 'Multiple Choice') ? 'block' : 'none'; ?>;">
    <label class="col-sm-2 col-form-label">Choices</label>
    <div class="col-sm-4" id="dynamicChoices">
        <?php
        if (isset($existingQuestionType) && $existingQuestionType == 'Multiple Choice') {
            $choicesArray = explode(', ', $existingChoices);
            foreach ($choicesArray as $index => $choice) {
                echo '<textarea class="form-control" name="choices[]" placeholder="Enter Choice ' . ($index + 1) . '">' . $choice . '</textarea>';
            }
        } else {
            // Display nothing or customize as needed when question type is not "Multiple Choice"
            // For example, you might display a message or leave it empty
            echo '<textarea style="display: none;" class="form-control" name="choices[]" placeholder="Enter Choice 1"></textarea>';
        }
        ?>
    </div>
</div>


                            <div class="form-group row">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-10">
                                    <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('question_type').addEventListener('change', function () {
        var choicesContainer = document.getElementById('choicesContainer');
        var dynamicChoicesContainer = document.getElementById('dynamicChoices');
        var selectedType = this.value;

        // Clear existing choices when changing the question type
        dynamicChoicesContainer.innerHTML = '';

        if (selectedType === 'Multiple Choice') {
            var numChoices = prompt("Enter the number of choices:");

            if (numChoices) {
                for (var i = 1; i <= numChoices; i++) {
                    var textarea = document.createElement('textarea');
                    textarea.className = 'form-control';
                    textarea.name = 'choices[]'; // Use an array to handle multiple choices
                    textarea.placeholder = 'Enter Choice ' + i;
                    dynamicChoicesContainer.appendChild(textarea);
                }

                choicesContainer.style.display = 'block';
            } else {
                this.value = '';
                choicesContainer.style.display = 'none';
            }
        } else {
            choicesContainer.style.display = 'none';
        }
    });
</script>


<?php
include('footer.php');
?>
