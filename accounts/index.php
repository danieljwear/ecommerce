<?php

// Create or access a Session
session_start();

require_once '../paths.php';
require_once LIB.'connections.php';
require_once MODEL.'acme-model.php';
require_once MODEL.'accounts-model.php';
require_once LIB.'functions.php';

$navList=nav();
//// Account Info IN Header
if (isset($_GET['logout'])) {
  logoff();
}


if (isset($_SESSION['loggedin'])) {
  $clientData = getClient($_SESSION['clientData']['clientEmail']);
  array_pop($clientData);
  $name = $_SESSION['clientData']['clientFirstname'];
}
  if (isset($_SESSION['loggedin'])) { 

    $accountLink = "<div class='welcome'> Welcome $name  </div>";
    $accountLink.=  '<div class="login"><img src="images/site/account.gif" alt="account"> <a href="./accounts/"> My Account  </a></div>';
    $accountLink.= "<div id='logout'><a href='./accounts/index.php?logout=true'>Logout</a></div> ";
             } else {
        $accountLink =  '<div class="login"><img src="images/site/account.gif" alt="account"> <a href="./accounts/"> My Account  </a></div>';
           
          }

          ////Account Info Ends

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

/// Form Fields

$createAccount  = '<a href="./accounts/?action=register"> Register Now </a>';
$loginPage  = '<a href="./accounts/?action=login"> Login Now </a>';
$updateuser  = '<a href="./accounts/?action=updateUser"> Update your account </a>';


switch ($action){
  case 'register':
 //print_r($_POST);
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname',FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL,FILTER_VALIDATE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_STRING);

$existingEmail = checkExistingEmail($clientEmail);


// Check for existing email address in the table
if($existingEmail){
 $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
 include '../view/login.php';
 exit;
}


$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);




if  (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
  $message='<div class="red"> Please provide information for all empty form fields.</div>';
  include '../view/register.php';
  exit;
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);


// Check and report the result
if ($regOutcome === 1) {
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');



  $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
  header('Location: /acme/accounts/?action=login');
  exit;
} else {
  $message ="<p> Sorry $clientFirstname, but the registration failed. Please try again. </p>";
  include '../view/register.php';
  exit;
}


exit;

   break;
  

   ///LOGIN//// 
 case 'login':

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
 setcookie('firstname', $_SESSION['clientData']['clientFirstname'], time() - 3600 );

 // Send them to the admin view
 include '../view/admin.php';
 exit;
 break;


 case 'updateUser':
 // Filter and store the data
 $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
 $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
 $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
 $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

 $clientEmail = checkEmail($clientEmail);

 if($_SESSION['clientData']['clientEmail'] <> $clientEmail) {
     $existingEmail = checkExistingEmail($clientEmail);
 } else { $existingEmail = FALSE; }

 // Check for existing email address in the table
 if($existingEmail){
 $message = '<p class="notice">That email address you are changing to already exists.</p>';
 include '../view/updateUser.php';
 exit;
 }

 // Check for missing data
 if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
     $message = '<p>Please provide information for all empty form fields.</p>';
     include '../view/updateUser.php';
     exit; 
 }

 $regOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

 // Check and report the result
 if($regOutcome === 1){
     setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
     $message = "<p>Thanks for updating your info $clientFirstname.</p>";
     include '../view/admin.php';
     exit;
 } else {
     $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
     $clientData = getClient($_SESSION['clientData']['clientEmail']);
     include '../view/updateUser.php';
     exit;
 }
 include '../view/updateUser.php';
 exit;
break;




case 'updatePassword':
// Filter and store the data
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
$checkedPassword = checkPassword($clientPassword);
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
// $clientData = getClient($_SESSION['clientData']['clientEmail']);
// Check for missing data
if(empty($checkedPassword)) {
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/updateUser.php';
    exit; 
}
$regOutcome = updatePassword($hashedPassword, $clientId);
// Check and report the result
if($regOutcome === 1){
    $message = "<p>Thanks for updating your password $clientData[clientFirstname].</p>";
    include '../view/admin.php';
    exit;
} else {
    $message = "<p>Sorry $clientData[clientFirstname], but the password update failed. Please try again.</p>";
    include '../view/updateUser.php';
    exit;
}
include '../view/updateUser.php';

 exit;
break;

 default:
 include '../view/login.php';
}


?>