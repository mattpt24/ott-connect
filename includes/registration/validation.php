<?php


  //Allow letters, hyphens and spaces only - strip others
  function clean( $string ) {
    $string = str_replace(' ', '-', $string);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
  }

  function cleanInt( $int ) {
    return $int = str_replace(' ', '', $int);
  }

  //Check for empty variables
  function hasEmptyField( $first_name, $last_name, $email, $phone_number, $company_name) {
    $result;
    if( empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($company_name) ) {
      // CREATE SESSION VARIABLE FOR EACH OF THESE WHICH HAD BEEN ADDED
      $result = true;
    } else {
      $result = false;
    }
    return $result;
  }

  //Validate string 
  function invalidString( $string ) {
    $result;
    if( preg_match("/^([a-zA-Z]*)/", $string) ) {
      $result = false;
    } else {
      $result = true;
    }
    return $result;
  }

  function cleanString( $string ) {
    $result;
    if( preg_match("/^([a-zA-Z0-9 -]*)/", $string) ) {
      $result = false;
    } else {
      $result = true;
    }
    return $result;
  }

  //Validate int 
  function invalidInt( $int ) {
    $result;
    if( preg_match("/^([0-9 ]*)/", $int) ) {
      $result = false;
    } else {
      $result = true;
    }
    return $result;
  }

  

  //Validate Contact number
  function invalidContactNo( $contactNo ) {
    $result;

    if( preg_match("/([+\s]|[\d]+[-\s]?)/", $contactNo )) {
      $result = false;
    } else {
      $result = true;
    }
    return $result;
  }

  //Validate email address
  function invalidEmail( $email ) {
    $result;
    //Check that the email has been well formed
    if( filter_var( $email, FILTER_VALIDATE_EMAIL )) {

      //Split the email where the @ symbol is and keep the latter part
      $domain = explode('@', $email)[1];

      //Check if the domain has an MX record to validate it as real
      if(checkdnsrr($domain, 'MX')) {
        $result = false;
      }
    } else {
      $result = true;
    }
    return $result;
  }

  //Honeypot
  function honeypot( $website ) {
    $result;
    if( empty($website) ) {
      $result = false;
    } else {
      $result = true;
    }
    return $result;
  }



  // function invalidName( $full_name ) {
  //   $result;
  //   if( ) {
  //     $result = true;
  //   } else {
  //     $result = false;
  //   }
  //   return $result;
  // }