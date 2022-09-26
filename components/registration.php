<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';







if(isset($_POST['submit'])) { 



  // Require Validation
  require_once('../includes/registration/validation.php');

  // Require validation messages
  require_once('../includes/registration/messages.php');

  //Login credentials
  require_once('../includes/registration/credentials.php');

  
  //Establish database connection
  $conn = new mysqli($host, $dBUsername, $dBPassword, $dBName);
  
  //Check connection - if fails, end with a error notice.
  if(mysqli_connect_error()){
    die("Connection error: (" . mysqli_connect_errno() . ")" . mysqli_connect_error());
  } else {

    //Require validation functions
    require_once("../includes/registration/validation.php");

    //Require message handling
    // require_once("../includes/registration/messages.php");

    //Assigning submitted details to variables
    $first_name = $_POST["fname"];
    $last_name = $_POST["sname"];
    $email = $_POST["contact-email"];
    $phone_number = $_POST["contact-number"];
    $company_name = $_POST["company-name"];
    $which_events = implode(", ", $_POST["event"]);
    $website = $_POST["website"];

    // Check if fields passed in are empty - if so, redirect with error message and exit registry process
    if( hasEmptyField($first_name, $last_name, $email, $phone_number, $company_name) !== false) {
      header("location:../register.php?error=missing-values");
      exit();
    }

    // Check name passes validation 
    if( invalidString($first_name) !== false ) {
      header("location:../register.php?error=first-name");
      exit();
    }
    

    if( invalidString($last_name) !== false ) {
      header("location:../register.php?error=last-name");
      exit();
    }


    // Check contact number passes validation 
    if( invalidContactNo($phone_number) ) {
            header("location:../register.php?error=phone-number"); 
      exit();
    }

        //Check email passes validation 
        if( invalidEmail( $email )) {
          header("location:../register.php?error=email");       
    exit();
  }


    // Check company name passes validation 
    if( cleanString($company_name) ) {
           header("location:../register.php?error=company-name");          
      exit();
    }




    if(!empty($website)) {
      http_response_code(403);
      die('<p style="color: #28348b">Your form submission contained fields which are <strong>not</strong> allowed.</p><p style="color: #28348b">If you believe this is a mistake, please try again.</p>');
    }




    //Create a PHP prepare statement to insert details in the entries table
    $stmt = $conn->prepare("INSERT INTO event_registration(first_name, last_name, email, phone_number, company_name, which_events) VALUES (?, ?, ? , ?, ?, ?)");

    /** 
     * 'Bind' the details submitted to SQL insert statement. 
     * - Define character type as "i" for integer
     * - Define character type as "d" for double
     * - Define character type as "b" for blob
     * - Define character type as "s" for string
     * 
     */

    $stmt->bind_param("sssiss", $first_name, $last_name, $email, $phone_number, $company_name, $which_events);

    // Run the query and close 
    $stmt->execute();
    $stmt->close();
    $conn->close(); 
    



    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    // Assign Variables
    $name      = "OTT Connect";
    $from      = "events@ott-connect.com";
    $password  = "%PCZ5=[A}WpIF";
    $recipient = $email;
    $subject   = "OTT Connect - Event Registration Confirmation";
    $body      = "
    <table style='padding: 20px 0' bgColor='lightgrey' cellpadding='0' cellspacing='0' width='100%' height='100%' align='center'>
    <tr>
      <td>
        <table bgColor='dark#2b2b2b' cellpadding='0' cellspacing='0' width='600' align='center'>
          <tr>
            <td style='width: 100%; display: block'>
              <div style='padding: 40px 0; background: #ffffff; text-align: center'>
              <img style='padding: 10px 0' width='600' src='https://bpl.circdata-solutions.co.uk/Fusion//client_files/default/DynamailImages/ott-connect/ott-connect-email-header.png'>
              <h1 style='color: #28348b'>Registration Request Received</h1>
              <p style='color:#222'>Hi  $first_name,<br><br>Thank you for registering your interest in attending our OTT Connect events.</p>
              <p style='color:#222'>You have have selected events in the following location(s): <br> <span style='color: #28348b'>$which_events</span></p>
             <p style='color:#222'><span style='color:crimson'>Please Note:</span> We will contact you again within 30 days to confirm your registration <br> and with further details about the events you have requested to attend.</p>
              <p style='color:#222'>We hope to see you soon!</p><br>
              <a href='ott-connect.com' style='border: none; outline: none; color:#28348b'><strong>Visit OTT Connect site<br><br><hr></strong></a>
              </div>
              </td>
              </tr>
              </table>
            </td>
          </tr>
        </table>
    ";


    //Server settings
    $mail->isSMTP();                                                //Send using SMTP
    $mail->Host       = 'mail.ott-connect.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
    $mail->Username   = $from;                                      //SMTP username
    $mail->Password   = $password;                                  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                //Enable implicit TLS encryption
    $mail->Port       = 465;      

    // Contents
    $mail->          isHTML(true);  
    $mail->Body       = $body;
    $mail->AltBody    = 'This is the body in plain text for non-HTML mail clients'; 
    $mail->Subject    = $subject; 
    $mail->          setFrom($from); 
    $mail->          addAddress($recipient);   


        if($mail->send()) {
          header("location:../success.php");
        }

        else {
          echo "Error...!";
        }

    // Close SMTP Connection
    $mail-> smptpClose();






 
    // Send user to following page after
  }

    
} else {
  //Set HTTP response to a 403 forbidden
  http_response_code(403);
  die('Forbidden');
}