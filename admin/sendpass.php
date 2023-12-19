<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '..\phpmailer/src/Exception.php';
    require '..\phpmailer/src/PHPMailer.php';
    require '..\phpmailer/src/SMTP.php';

    if(isset($_POST['send'])) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mnznchrls@gmail.com';
        $mail->Password = '09296161827';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('mnznchrls@gmail.com');   
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);

        // Set the subject and body of your email
        $mail->Subject = 'Subject of your email';
        $mail->Body = 'Body of your email';

        $mail->SMTPDebug = 2;

        try {
            // Other PHPMailer code...

            $mail->send();

            // Email sent successfully, show success popup
            echo '
            <div class="popup popup--icon -success js_success-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                    <h3 class="popup__content__title">
                        Success 
                    </h3>
                    <p>Password is sent to your email address</p>
                    <p>
                        <script>setTimeout("location.href = \'login_admin.php?userid=$row[userid]\';", 1500);</script>
                    </p>
                </div>
            </div>';
        } catch (Exception $e) {
            // Handle email sending failure here
            echo 'Email sending failed. Error: ' . $mail->ErrorInfo;
        }
    }
?>