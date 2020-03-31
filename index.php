<?php
// Create or access a Session
session_start();
require_once 'paths.php';
require_once LIB.'connections.php';
require_once MODEL.'acme-model.php';
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



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


//echo $navList;
//exit;



 

switch ($action){
  case 'something':
   
   break;

   
  
  default:
   include 'view/home.php';
 }
?>