<?php

/*
 * Accounts Controller
 */

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
//Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Create or access a Session
session_start();
// Get the array of categories
$categories = getCategories();
// Dynamic Nagigation
$navList = dynamicNavigation();

//$action is a variable used to store the type of content being requested.
//function that sifts the content to eliminate code that could do the website harm
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}

//Each case statement represents a different process to execute. 
switch ($action) {
 case 'login-page' :
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
  break;
 
 
 
 

 case 'loggedin':
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
  exit;
  break;
 
 
 
 

 case 'logout':
  session_destroy();
  header('Location: /acme/index.php');
  setcookie('firstname', '', strtotime('-1 year'), '/');
  exit;
  break;
 
 
 
  case 'update':
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
   exit;
   break;
 
 
 

 case 'login':

  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientEmail = checkEmail($clientEmail);
  $passwordCheck = checkPassword($clientPassword);

  //Check if either of the variables are empty
  //message and call the login view using a PHP include function
  if (empty($clientEmail) || empty($passwordCheck)) {
   $message = '<p>Please provide a valid email address and password.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
   exit;
  }
  //when a valid password exists, proceed with login process
  $clientData = getClient($clientEmail); //query database for client email
  $hashCheck = password_verify($clientPassword, $clientData['clientPassword']); //query database for client password
  //error handling for password no match
  if (!$hashCheck) {
   $message = '<p>Please check your password and try again.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
   exit;
  }
  //login valid user
  $_SESSION['loggedin'] = TRUE;
  array_pop($clientData);
  $_SESSION['clientData'] = $clientData;
  setcookie('firstname', '', strtotime('-1 year'), '/');
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
  exit;
  break;
  
  
  

 //add a case to only show the registration form
 case 'register-page':
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
  break;
 
 
 
 

 //this is processing the registration form
 case'register':
  // Filter and store the data
  $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
  $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientEmail = checkEmail($clientEmail);
  $checkPassword = checkPassword($clientPassword);

  // Check for an existing email
  $existingEmail = checkExistingEmail($clientEmail);
  if ($existingEmail) {
   $message = '<p>It looks like you already have an account. Do you want to login instead?</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
   exit;
  }
// Check for missing data
  if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
   $message = '<p>Please provide information for all empty form fields.</p>';

   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
   exit;
  }
  $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
  $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
// Check and report the result
  if ($regOutcome === 1) {
      $_SESSION['message'] = "<p>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      header('Location: /acme/accounts/?action=login');
      //include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
      exit;
     } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
      exit;
      }
  break;
  
  
  
  
  
  case 'updateClientInfo':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $existingEmail = checkExistingEmail($clientEmail);
    // Check for match with current session email
    if($clientEmail != $_SESSION['clientData']['clientEmail']){
      if ($existingEmail) {
        $message = '<p>This email is already in use.</p>';
        include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
        exit;
      }
    }
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
      $message = '<p>All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
      exit;
    }
    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
    if ($updateResult){
       $message = "<p>Your account has been updated!</p>";
       $_SESSION['message'] = $message;
       $_SESSION['clientData'] = getClient($clientEmail);
       header('location: /acme/accounts/');
       exit;
     } else {
       $message = "<p>Sorry, something went wrong. Please try again.</p>";
       header('location: /acme/accounts/');
       exit;
     }
    exit;
    break;
  
    
    
    
  case 'updateClientPassword':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);
    if (empty($checkPassword)){
      $passwordMessage = '<p>Looks like you did not enter valid password.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
      exit;
    }
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    $newPasswordOutcome = updatePassword($hashedPassword, $clientId);
      if($newPasswordOutcome === 1){ 
         $passwordMessage = "<p>Password updated!</p>";
         $_SESSION['message'] = $passwordMessage;
         header('location: /acme/accounts/');
         exit;
       } else {
         $passwordMessage = "<p>Sorry, something went wrong. Please try again.</p>";
         $_SESSION['message'] = $passwordMessage;
         header('location: /acme/accounts/');
         exit;
       }
    break;
    
    default:
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
      break;
    
   
}
