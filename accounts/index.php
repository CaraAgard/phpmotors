<?php

// Create or access a Session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicle-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/uploads-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/accounts-model.php';





$classifications = getClassifications();

$navList = navagationList($classifications);
echo $navList;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}
$reviewHolder = '';

switch ($action){
    case 'register':
        // Filter and store the data
          $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
          $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
          $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
          $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
          $clientEmail = checkEmail($clientEmail);
          $checkPassword = checkPassword($clientPassword);
         
          $existingEmail = checkExistingEmail($clientEmail);

          // Check for existing email address in the table
          if($existingEmail){
           $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
           include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/login.php';
           exit;
          }


        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/registration.php'; 
          exit;
        }

        
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        
        // Check and report the result
        if($regOutcome === 1){
          setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
          $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
          header('Location: /phpmotors/accounts/?action=Log-In');
          exit;
        } else {
          $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/registration.php';
          exit;
        }
        break;

        case 'Log-In':
          $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
          $clientEmail = checkEmail($clientEmail);
          $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
          $passwordCheck = checkPassword($clientPassword);

          // Run basic checks, return if errors
          if (empty($clientEmail) || empty($passwordCheck)) {
          $message = '<p class="notice">Please provide a valid email address and password.</p>';
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/login.php';
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
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/login.php';
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
          $AddReview = buildReviewList($_SESSION['clientId']['clientData']);
          // Send them to the admin view
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/admin.php';
          exit;
          


          break;

        case 'login-page':  
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/login.php';
            break;

        case 'home-view':
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/home.php';
            break;

        
        case 'deliverRegisterView':
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/registration.php'; 
            break;

            case 'admin':
              include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/admin.php';
              break;

        case 'logout':
          session_destroy();
          unset($_SESSION);
          setcookie('PHPSESSID', '', strtotime('-1 hour'), '/');
          header('Location: /phpmotors/');
          break;

          case 'clientUpdate':
          
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/client-update.php';
              break;

    
      
      if ($updateResult) {
        $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
       }
      else {
        $message = "<p>It didn't update. Please try again.</p>";
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle-update.php';
        exit;
      }

      case 'modclient':
        $clientId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $clientInfo = getClientItemInfo($clientId);
        if(count($clientInfo)<1){
          $message = 'Sorry, no client information could be found.';
         }
         include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/client-update.php';
          
      break;

      
      case 'AccountUpdate':
       
          $clientId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
          $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
          $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
          $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
          

if (empty($clientId) || empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
$message = '<p>Please complete all information for the new item! Double check  the item.</p>';
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/client-update.php';
exit;
}
$clientResult = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);
if ($clientResult) {
	$message = "<p>Congratulations, the update was successful.</p>";
  $_SESSION['message'] = $message;
  header('location: /phpmotors/vehicles/');
	exit;
} else {
	$message = "<p>Error. The new update was not added.</p>";
	include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/client-update.php';
	exit;
 
}
    break;

        /* * ********************************** 
* Get clients by clientId 
* Used for starting Update  
* ********************************** */ 
case 'getClientItems': 
  // Get the classificationId 
  $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT); 
  // Fetch the vehicles by classificationId from the DB 
  $clientArray = getClientByClassification($clientId); 
  // Convert the array to a JSON object and send it back 
  echo json_encode($clientArray); 
  break;

  

  case 'updatePassword':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    

if (empty($clientId) || empty($clientPassword)) {
$message = '<p>Please complete all information for the new Password! .</p>';
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/client-update.php';
exit;
}
$passwordResult = updatePassword($clientId, $clientPassword);
if ($passwordResult) {
$message = "<p>Congratulations, the password was successful.</p>";
$_SESSION['message'] = $message;
header('location: /phpmotors/vehicles/');
exit;
} else {
$message = "<p>Error. The new password was not added.</p>";
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/client-update.php';
exit;
}
    break;

      
default:

        if(isset($_SESSION['clientData']['clientId'])) {
          $clientId = $_SESSION['clientData']['clientId'];
        }
        $clients = '';
        

        $clientReviews = getReviewsByClient($clientId);
        $listOFClientRevs = buildReviewList($clientReviews);
      
     include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/admin.php';
 
     
  break;

        
        
        }
        
    ?>