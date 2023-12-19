<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '..\phpmailer/src/Exception.php';
    require '..\phpmailer/src/PHPMailer.php';
    require '..\phpmailer/src/SMTP.php';

    if(isset($_POST['send'])) {
        
        $mail = new PHPMailer(true);
        
        // Set CA file and SSL options
        $mail->SMTPOptions = array(
            'ssl' => array(
                'cafile' => 'C:\samp\apache\bin\cacert.pem', // Change to the actual file name
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

        // Set the subject and body of your email
        $mail->Subject = 'Subject of your email';
        $mail->Body = 'Body of your email';


      
    }
?>