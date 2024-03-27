<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rebison2@gmail.com';                     //SMTP username
    $mail->Password   = 'vlkm hxnd lhvx awjx';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $interested_domain = $_POST['interested_domain'];
        $position = $_POST['position'];

        // Email details
        $subject = 'New Contact Form Submission';
        $message = "<b>Name:</b> $name<br>";
        $message .= "<b>Email:</b> $email<br>";
        $message .= "<b>Phone:</b> $phone<br>";
        $message .= "<b>Interested Domain:</b> $interested_domain<br>";
        $message .= "<b>Current Position:</b> $position<br>";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Contact Enquiry';
        $mail->addAddress($email);
        $mail->addBCC('rebison2@gmail.com');
        $mail->Body    =  $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Success';
    } else {
        echo 'Invalid';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
