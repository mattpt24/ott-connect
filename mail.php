<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require './register.php';



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);



////////////////////////////////////////////////////// SEND EMAIL FUNCTION


if(isset($_POST['submit'])) {

    // Assign Variables
    $name = "OTT Connect";
    $from = "ott-connect@gmail.com";
    $password = "password";
    $recipient = $_POST["contact-email"];
    $subject = "OTT Connect - Event Registration";
    $body = "<h1>This is the body of the email!</h1>";


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->Username   = $from;                  
    $mail->Password   = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;     

    // Contents
    $mail->          isHTML(true);  
    $mail->Body       = $body;
    $mail->Subject    = $subject; 
    $mail->          setFrom($from, $name); 
    $mail->          addAddress($recipient);   


        if($mail->send()) {
        echo 'Message has been sent';
        }

        else {
            echo "Error..!";
        }

    // Close SMTP Connection
    $mail-> smptpClose();
}

// 


?>