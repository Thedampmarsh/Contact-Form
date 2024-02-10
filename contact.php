<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '/home/sanctifiedsecur/public_html/PHPMailer/src/Exception.php';
    require '/home/sanctifiedsecur/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/sanctifiedsecur/public_html/PHPMailer/src/SMTP.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'mail.sanctifiedsecurity.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marshall@sanctifiedsecurity.com';
        $mail->Password = 'ORvFzIEGKuWF77e1eUpt2iXg66DIEdt';
        $mail->Port = 465; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->isHTML(false);
        $mail->setFrom('marshall@sanctifiedsecurity.com', $_POST['name']);
        $mail->addAddress('marshall@sanctifiedsecurity.com');
        $mail->Subject = 'New Project Inquiry';
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
