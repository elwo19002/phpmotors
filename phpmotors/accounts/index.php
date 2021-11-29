<?php
// Create or access a Session
session_start();
   require_once '../library/connections.php';
   require_once '../model/main-model.php';
   require_once '../model/accounts-model.php';
   require_once '../library/functions.php';

$classifications = getClassifications();
$navList = navigationPopulation($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

case 'register':
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if($existingEmail){
    $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
    include '../view/login.php';
    exit;
    }
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/registration.php';
          exit; 
        }
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
    if($regOutcome === 1){
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } 
    else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }

//link to login page
case 'login':
  include '../view/login.php';
  break;
  
//button to login to phpmotors
case 'Login':
  
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientEmail = checkEmail($clientEmail);
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $passwordCheck = checkPassword($clientPassword);
  // Run basic checks, return if errors
  if (empty($clientEmail) || empty($passwordCheck)) {
  $message = '<p class="notice">Please provide a valid email address and password.</p>';
  include '../view/login.php';
  exit;
  }
    
  // A valid password exists, proceed with the login process
  // Query the client data based on the email address
  $clientData = getClient($clientEmail);
  // Compare the password just submitted against
  // the hashed password for the matching client
  $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
  // If the hashes don't match create an error
  // and return to the login view
  if(!$hashCheck) {
    $message = '<p class="notice">Please check your password and try again.</p>';
    include '../view/login.php';
    exit;
  }
  // A valid user exists, log them in
  $_SESSION['loggedin'] = TRUE;
  // Remove the password from the array
  // the array_pop function removes the last
  // element from an array
  array_pop($clientData);
  // Store the array into the session
  $_SESSION['clientData'] = $clientData;
  // Send them to the admin view
  include '../view/admin.php';
  exit;
    break;

case 'create':
  include '../view/registration.php';
  break;

  
case 'Logout':
  unset($_SESSION['$clientData']);
  session_destroy();
  include '../view/login.php';
  break;

case 'updateClientView':
  include '../view/client-update.php';
  break;

case 'updateAccount':
  $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
  $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  $clientEmail = checkEmail($clientEmail);
  if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
    $message = '<p>Please complete all the fields before submmitting your request.</p>';
    include '../view/client-update.php';
    exit;
  }
  if (($clientEmail) != $_SESSION['clientData']['clientEmail']) {
    $existingEmail = checkExistingEmail($clientEmail);
    if ($existingEmail) {
      $message = '<p class="notice">That email address already exists. Do you want to try a different email address?</p>';
      include '../view/client-update.php';
      exit;
    } 
  }
  $updateClient = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
  if ($updateClient === 1) {
    $clientData = getClient($clientEmail);
    $_SESSION['clientData'] = $clientData;
    $message = "<p class='notice'>Congratulations, $clientFirstname, your account was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/view/admin.php');
    exit;
  } else {
    $message = "<p class='error indent'>Error, $clientFirstname, your account was not updated.</p>";
    header('location: /phpmotors/view/client-update.php');
    exit;
  }   
  break;


case 'updatePassword':
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  if (empty($clientPassword)) {
    $message = '<p class="error indent">Please provide a password.</p>';
    include '../view/client-update.php';
    exit;
  }
  $checkPassword = checkPassword($clientPassword);
  if (($checkPassword)===0){
    $message= '<p class="error indent">Please select a new password that meets all the requirements.</p>';
    include '../view/client-update.php';
    exit;
  }
  $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
  $updatePassword = updatePassword($hashedPassword, $clientId);
  if ($updatePassword){
    $message = "<p class='notice'>Your password was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/accounts/');
    exit;
  }
  else {
    $message = "<p class='error indent'>Error. Your password was not updated.</p>";
    header('location: /phpmotors/accounts/');
    exit;
  }
  $_SESSION['clientData'] = $clientData; 
  break;



default:
  include '../view/admin.php';
}

?>