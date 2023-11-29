<?php require_once('check_login.php'); ?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('connect.php');

if (isset($_POST['btn_submit'])) {
    if (isset($_GET['editid'])) {
        $sql = "INSERT INTO tbl_physical (questions, question_type, choices) VALUES ('$_POST[questions]', '$_POST[question_type]', '$_POST[choices]')";

        if ($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                    <h3 class="popup__content__title">
                        Success
                    </h3>
                    
                </div>
            </div>
<?php
        } else {
            echo mysqli_error($conn);
        }
    }
}

if(isset($_GET['editid']))
{
    $sql="SELECT * FROM tbl_physical WHERE question_id='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);

}
?>

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-body">
                <div class="card">
                    <div class="card-header"><h1>Physical Assessment</h1></div>
                    <div class="card-block">
                        <hr>
                        <form id="main" method="post" action="" enctype="multipart/form-data">

                            <style>
                                #Question {
                                    height: 100px; /* Adjust the height as needed */
                                }
                            </style>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Question</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="questions" id="questions" placeholder="Enter a Question" required=""><?php if (isset($_GET['editid'])) {
                                                                                                                                                    echo $rsedit['questions'];
                                                                                                                                                } ?></textarea>
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
                                            if ($val == $rsedit['question_type']) {
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
                            <div class="form-group row" id="choicesContainer" style="display: none;">
                                <label class="col-sm-2 col-form-label">Choices</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" name="choices" id="choices"></textarea>
                                    <span class="messages"></span>
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
</div>
</div>
</div>
</div>
</div>
</div>

<script>
   document.getElementById('question_type').addEventListener('change', function() {
    var choicesContainer = document.getElementById('choicesContainer');
    var selectedType = this.value;
    if (selectedType === 'Multiple Choice') {
        choicesContainer.style.display = 'block';
    } else {
        choicesContainer.style.display = 'none';
    }
});

</script>

<?php include('footer.php'); ?>
