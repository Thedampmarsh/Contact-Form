<?php
    require __DIR__.'/src/Exception.php';
    require __DIR__.'/src/PHPMailer.php';
    require __DIR__.'/src/SMTP.php';

   # use "use" after include or require

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;


$msg = '';
$name = $_POST['name']; 
$phone = $_POST['phone']; 
$email = $_POST['email']; 
$message = $_POST['message']; 
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
        $mail->Subject = 'PHPMailer contact form';
        date_default_timezone_set('Etc/UTC');
 
        $smtpUsername = getenv('marshall@sanctifiedsecurity.com');
        $smtpPassword = getenv(']tiIC"k6sJ}ur~%.bLch<;DaPp;APxA');
        
        // Create a PHPMailer instance
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'mail.sanctifiedsecurity.com';
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->Port = 587; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->setFrom('from@example.com', 'First Last');
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but it's unsafe to display errors directly to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }


?>
                // Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
                // $mail->isSMTP();  // Set mailer to use SMTP
                // $mail->Host = 'mail.sanctifiedsecurity.com';  // Specify SMTP server
                // $mail->SMTPAuth = true;  // Enable SMTP authentication
                // $mail->Username = 'marshall@sanctifiedsecurity.com';  // SMTP username
                // $mail->Password = ']tiIC"k6sJ}ur~%.bLch<;DaPp;APxA';  // SMTP password
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable implicit TLS encryption
                // $mail->Port = 587;  // TCP port (for ENCRYPTION_STARTTLS, use 465)
