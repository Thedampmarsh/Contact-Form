<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '/home/sanctifiedsecur/public_html/PHPMailer/src/Exception.php';
    require '/home/sanctifiedsecur/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/sanctifiedsecur/public_html/PHPMailer/src/SMTP.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $msg = '';
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'mail.domain.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'emailUser';
        $mail->Password = 'ORvFzIEGKuWF77e1eUpt2iXg66DIEdt';
        $mail->Port = 465; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->isHTML(false);
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('recipientAddress');
        $mail->Subject = 'New Project Inquiry';
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
 //Attach multiple files one by one
    for ($ct = 0, $ctMax = count($_FILES['userfile']['tmp_name']); $ct < $ctMax; $ct++) {
        //Extract an extension from the provided filename
        $ext = PHPMailer::mb_pathinfo($_FILES['userfile']['name'][$ct], PATHINFO_EXTENSION);
        //Define a safe location to move the uploaded file to, preserving the extension
        $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['userfile']['name'][$ct])) . '.' . $ext;
        $filename = $_FILES['userfile']['name'][$ct];
        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$ct], $uploadfile)) {
            if (!$mail->addAttachment($uploadfile, $filename)) {
                $msg .= 'Failed to attach file ' . $filename;
            }
        } else {
            $msg .= 'Failed to move file to ' . $uploadfile;
        }
    }
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
