<?php
    require __DIR__.'/src/Exception.php';
    require __DIR__.'/src/PHPMailer.php';
    require __DIR__.'/src/SMTP.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    try {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'mail.sanctifiedsecurity.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marshall@sanctifiedsecurity.com';
        $mail->Password = 'w8HK3hXxdzhLeAUuTZix1ZaMOmEPtSU';
        $mail->Port = 465; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->setFrom('from@example.com', 'First Last');
        $mail->isHTML(false);
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