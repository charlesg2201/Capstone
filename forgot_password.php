<?php
session_start();
include('head.php');
include('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['send'])) {
    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'cafile' => 'C:\samp\apache\bin\cacert.pem',
            'verify_peer' => true,
            'verify_peer_name' => true,
        ),
    );

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mnznchrls@gmail.com';
    $mail->Password = 'uqdpindyvjdldwbc';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('mnznchrls@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);

    if (isset($_POST['studentid'])) {
        $studentid = mysqli_real_escape_string($conn, $_POST["studentid"]);

        // Fetch the user based on the studentid
        $sql = "SELECT * FROM patient WHERE studentid='" . $studentid . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $password = $row['password'];
            $fname = $row['fname'];
            $mail->Subject = 'Your Password Recovery';
            $mail->Body = 'Hi ' .$fname .',' . ' ' . 'your password is: ' . $password;

            if ($mail->send()) {
                echo '
                <div class="popup popup--icon -success js_success-popup popup--visible">
                    <div class="popup__background"></div>
                    <div class="popup__content">
                        <h3 class="popup__content__title">
                            Success 
                        </h3>
                        <p>Password is sent to your email address</p>
                        <p>
                            <script>setTimeout("location.href = \'login_patient.php\';", 1500);</script>
                        </p>
                    </div>
                </div>';
            } else {
                echo 'Email sending failed';
            }
        } else {
            echo '
            <div class="popup popup--icon -error js_error-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                    <h3 class="popup__content__title">
                        Error 
                    </h3>
                    <p>Username not found</p>
                    <p>
                        <a href="forgot_password.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
                    </p>
                </div>
            </div>';
        }
    } else {
        echo '
        <div class="popup popup--icon -error js_error-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    Error 
                </h3>
                <p>Username not provided</p>
                <p>
                    <a href="forgot_password.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
                </p>
            </div>
        </div>';
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body class="fix-menu">
    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form class="" method="post" class="md-float-material form-material">
                    <div class="auth-box card" style="background-color: rgba(255, 255, 255, 0.5);">
                    <div class="text-center">
                    <image class="profile-img" src="uploadImage/Logo/shslogo.png" style="width: 30%; margin-top: 20px; border-radius: 50%;"></image>
                     </div> 
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                    <h4 class="text-center txt-primary" style="color: black;">Recover your password</h4>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                            <input type="text" name="studentid" class="form-control" required="" placeholder="Enter your username">
                            <span class="form-bar"></span>
                        </div>
                                <div class="form-group form-primary">
                                    <input type="email" name="email" class="form-control" required="" placeholder="Enter your active email address">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="send" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">Submit</button>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <script type="text/javascript" src="../files/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="../files/assets/js/common-pages.js"></script>
</body>
</html>
