<?php 

  require_once('validation.php');

  //Check if any error parameters are in the URL
  if(isset($_GET['error'])) {

    //While we set our own validation names; sanitise, just in case.
    $error = clean($_GET['error']);

    //Set empty error message
    $err_msg = '';

    //Check the error messages    
    if( $error == "missing-values" ) {
      $err_msg .= '<li>Please fill in the missing field(s)</li>';
    } elseif( $error == "first-name" || $error == "last-name" || $error == "phone-number" ||  $error == "email" || $error == "company-name"  ) {
      $err_msg .= '<li>Please check your details are correct.</li>';
    } else {
      $err_msg .= '<li>We appear to have encountered an error. Please try again.</li>';
    }



    echo "<div class='message message--error' role='alert'><ul style='list-style: none'>$err_msg</ul></div>";

  } 
?>