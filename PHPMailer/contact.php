<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '/home/user/public_html/PHPMailer/src/Exception.php';
    require '/home/user/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/user/public_html/PHPMailer/src/SMTP.php';

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    $file_path = "/absolutePath";
    $msg = '';
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.domain.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = 'ncwio4uhr5v982b34765923847b65cf3948765t9387f46rt97384ydhr9738y4fr9346c57f3497856hvf4938756tcg437968fdytrg6743865r46735f3c49b4563';
        $mail->Port = 465; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->isHTML(false);
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('name@email.com');
        // $mail->addAddress('cameron.wood.business@gmail.com');
        $mail->Subject = 'New Project Inquiry';
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
 //Attach multiple files one by one
 if (!empty($_FILES['userfile']['tmp_name'])) {
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
 }
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
//   echo readfile($file_path);

    
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Message Sent</title>
<style>
body{
        height:90vh;
                background-color: black;
                margin:0;
                padding:0;
                box-sizing: border-box;
}
    .message-container {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        height:100%;
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        gap:3px;
    color:green;
    }
    .message {
        font-size: 24px;
        color: #008000; /* Green color */
        padding: 20px;
    }
        button {
            border: double 3px green;
        font-size: 24px;
        padding: 10px 20px;
        background-color: black;
        color: green;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
        button:hover {
        background-color: green;
        color:black;
    }
</style>
</head>
<body>
    <div class="message-container">
        <p class="message">Message sent</p>
        <button onclick="goBack()">Go Back</button>
    </div>
    


    <script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>
HTML;
?>
