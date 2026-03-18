<?php

require 'files/lib/myPHPMailer/src/PHPMailer.php';
require 'files/lib/myPHPMailer/src/SMTP.php';
require 'files/lib/myPHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($sendMailTo, $sendMailToName, $mailSubject, $mailBody)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;  // Set to 2 for debugging purposes
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'davidjanp78@gmail.com'; // Your Gmail username
        $mail->Password = 'nilq louv kcgn pbiq'; // Your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('davidjanp78@gmail.com', 'Electronic Child Vaxcare System'); // Sender's email and name
        $mail->addAddress($sendMailTo, $sendMailToName); // Receiver's email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = $mailSubject;
        $mail->Body = '<html><body><p>' . $mailBody . '</p></body></html>';

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Sending the email
$sendMailTo = 'loadercrack19@gmail.com';
$sendMailToName = 'Crackloader';
$mailSubject = 'Hello Mr Crackloader This is David';
$mailBody = 'How are you doing';

sendEmail($sendMailTo, $sendMailToName, $mailSubject, $mailBody);

?>
