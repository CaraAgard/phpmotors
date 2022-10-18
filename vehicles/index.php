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

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
 }

 if(isset($reviewText)) {
   echo $reviewText;
 }
 if(isset($reviewList)) {
   echo $reviewList;
 }

switch ($action){
  

  case 'AddClass':
    // Filter and store the data
      $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
     // $classificationId = filter_input(INPUT_POST, 'classificationId');
     
     //$checkClassification = checkClassificationNameLength($classificationName);
     
    
    // Check for missing data
    if(empty($classificationName)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_classification'; 
      exit;
    }
    
    // Send the data to the model
    $classAdded = newClassification($classificationName);
    
    // Check and report the result
    if($classAdded === 1){
      header('Location: /phpmotors/vehicles/');
    }else {
      $message = '<p>An error happened.</p>';
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_classification'; 


    
     // $message = "<p>Thanks for registering $classificationName. Please add vehicle.</p>";
     // include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle'; 
     // exit;
    //} else {
     // $message = "<p>Sorry $classificationName, but the registration failed. Please try again.</p>";
      //include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_classification.php'; 
      exit;
    }
    break;


  case 'add_vehicle':
      // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));
        
      
      
       //Check for missing data
      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)|| empty($invPrice)|| empty($invStock)|| empty($invColor)|| empty($classificationId)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle'; 
        exit;
      }
      
      // Send the data to the model
      $addVehicle = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
      
      // Check and report the result
      if($addVehicle){
        $message = "<p>The ' . $invMake . ' ' . $invModel . ' was added.</p>";
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle';
        exit;
      } else {
        $message = "<p>It didn't work. Please try again.</p>";
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle';
        exit;
      }
      break;
        
      case 'AddCar':  
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle';
          break;
            
      case 'vehicle_management':
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_classification'; 
          break;
              
      case 'management':
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle_management'; 
            break;

      /* * ********************************** 
      * Get vehicles by classificationId 
      * Used for starting Update & Delete process 
      * ********************************** */ 
      case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;

        case 'mod':
          $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
          $invInfo = getInvItemInfo($invId);
          if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
           }
           include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle-update.php';
            
        break;

        case 'updateVehicle':
          // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
      
      
       //Check for missing data
      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)|| empty($invPrice)|| empty($invStock)|| empty($invColor)|| empty($classificationId)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle'; 
        exit;
      }
      
      // Send the data to the model
      $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId,$invId );
      
      // Check and report the result
      //if($updateResult){
        //$message = "<p>The ' . $invMake . ' ' . $invModel . ' was updated.</p>";
        //include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/add_vehicle';
        //exit;
      //} 
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

          break;
          
      case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
          $message = 'Sorry, no vehicle information could be found.';
         }
         include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle-delete.php';
	
      break;

     
        case 'deleteVehicle':
          $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
          $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
          $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
          
          $deleteResult = deleteVehicle($invId);
          if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
          deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          }
          break;
          
          case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)){
              $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
            } else {
              $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            //works in login view but not main index yet.
            //echo $vehicleDisplay;
            //exit;
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/classification.php';

            break;

            case 'vehicleStats':
              $pageTitle = 'Vehicle Details';
              $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
              $info = getInvItemInfo($invId);
              $getRVs = inventoryItemReview($invId);
              //print_r($info) ;
              if(!count($info)){
                $message = "<p class='notice'>Sorry, no $invId vehicles could be found.</p>";
              } else {
                $vehicleDisplayMore = buildVehiclesInfo($info, $getRVs);
              
              }
              
          
             include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle-detail.php';
              break;

            
      
      default:
      $classificationList = buildClassificationList($classifications);
      $clientReviews = getReviewsByClient($clientId);
      $listOFClientRevs = buildReviewList($clientReviews);
      
     
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle_management'; 
      break;
          
          
      
        
        }
    
    ?>