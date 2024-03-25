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
    $mail->Host       = 'smtp-relay.brevo.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rebison85@gmail.com';                     //SMTP username
    $mail->Password   = 'SK643ws29OyHUxgA';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('rebison2@gmail.com','Server');
    $mail->addAddress('rebison85@gmail.com');    //Add a recipient

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $qualification = $_POST['qualification'];
        $profile = $_POST['profile'];

        // Email details
        // $to = 'your_email@example.com';
        $subject = 'New Contact Form Submission';
        $message = "<b>Name:</b> $name\n";
        $message .= "<b>Email:</b> $email\n";
        $message .= "<b>Phone:</b> $phone\n";
        $message .= "<b>Qualification:</b> $qualification\n";
        $message .= "<b>Profile:</b> $profile\n";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Contact Enquiry';
        $mail->Body    =  $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
        // Send email
        // if (mail($to, $subject, $message)) {
        //     echo 'Your message has been sent successfully.';
        // } else {
        //     echo 'Unable to send email. Please try again later.';
        // }
    } else {
        echo 'Invalid request.';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>