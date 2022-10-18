<?php 
//Reviews Controller
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicle-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/uploads-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array

$navList = navagationList($classifications);
echo $navList;

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}





   


switch($action) {
    
    case 'review':
        //echo 'You are in the register review statement.';
      
        
        //if ($_POST) {
           // $text = $_POST["message"];
           // echo "<h2>$text</h2>";

        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        //$reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        
        


         //Check for missing data
         if(empty($reviewText)  || empty($invId) || empty($clientId)){
            $message = '<p>Please provide review in empty form field.</p>';
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle-detail.php'; 
            exit;
          }
         //Send the data to the model
        //  print_r($_SESSION);
        //  exit;
        
         $revOutcome = insertReview($reviewText,/* $reviewDate,*/ $invId, $clientId);
         
         
         // Check and report the result
         if($revOutcome === 1){
           //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
           //$_SESSION['message'] = "Thanks for writing a review.";
          // header('Location: /phpmotors/accounts/?action=Log-In');
          $message = "<p>Thanks for the review. Here it is:<h2> $reviewText.</h2></p><br><br><br>";
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/admin.php';
          
         // header('location: /phpmotors/vehicles');
           
           exit;
         } else {
           $message = "<p>Sorry didn't work $clientId.</p>";
          //  echo $revOutcome;
          //  exit;
           //include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/registration.php';
           include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/vehicle-detail.php';
           //include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/review-view.php';
           
           exit;
         }
         
         break;


        case 'deliver_view_to_delete':  
          $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
          $revInfo = getRevStuff($reviewId);
              if(count($revInfo) < 1){
                $message = 'Sorry, no review information could be found.';
                header('location: /phpmotors/accounts/');
               }
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/review_delete.php';
          exit;
            break;


           

        case 'handle_review_delete':
            //echo 'You are in the register review statement.';
        
        //if ($_POST) {
           // $text = $_POST["message"];
           // echo "<h2>$text</h2>";

        // Filter and store the data
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        // $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
        // $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        // $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $deleting = deleteSpecificReview($reviewId);

         // Check for missing data
        //  if(empty($reviewText)  || empty($invId) || empty($clientId)){
        //     $message = '<p>Please provide review in empty form field.</p>';
        //     include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/review_update.php'; 
        //     exit;
        //   }
        //  Send the data to the model
        //  print_r($_SESSION);
        //  exit;
        
         //$deleteOutcome = DeleteSpecificReview($reviewId);
         
         // Check and report the result
         if($deleting === 1){
           //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
           $_SESSION['message'] = "Thanks for deleting a review.";
           //header('location: /phpmotors/reviews/');
          // header('Location: /phpmotors/accounts/?action=Log-In');
           //exit;
         } else {
          $_SESSION['message'] = "<p>Sorry didn't work.</p>";
           //include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/registration.php';
           //include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/reviews/';
           
           //exit;
         }
         header('location: /phpmotors/accounts/');
         exit;
         break;
            $_SESSION['message'] = $message;
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
            break;

            /* * ********************************** 
          * Get reviews by clientId 
          * Used for starting Update & Delete process 
          * ********************************** */ 
          case 'getReviewItems': 
            // Get the classificationId 
            $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the vehicles by classificationId from the DB 
            $textArray = getReviewsByClient($clientId); 
            // Convert the array to a JSON object and send it back 
            echo json_encode($textArray); 
            break;


            case 'mod':
              $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
              $revInfo = getRevStuff($reviewId);
            //if(count($invInfo)<1){
              // $message = 'Sorry, no review information could be found.';
              if (empty($revInfo)) {
                $_SESSION['message'] = 'Sorry, no review information could be found';
               header('location: /phpmotors/accounts/');
               exit;
              }
             
              include '../view/review_update.php';
              exit;
             break;

            

    case 'handle_review_update':
          //echo 'You are in the register review statement.';
        
        //if ($_POST) {
           // $text = $_POST["message"];
           // echo "<h2>$text</h2>";

        // Filter and store the data
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        //$reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
       // $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        //$clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        

         // Check for missing data
         if(empty($reviewId)  || empty($reviewText)){
          $_SESSION['message'] =  'Please provide review in empty form field.';
          header('Location: /phpmotors/reviews/?action=mod&reviewId='.$reviewId);
             
            exit;
          }else { 
            
         $updateOutcome = updateSpecificReview($reviewId, $reviewText);
            if ($updateResult === 1) {
                $_SESSION['message'] = 'The review was successfully updated!';
            
             }else{
              $_SESSION['message'] = "<p>Updated.</p>";
            }
              header('location: /phpmotors/accounts/');
              exit;

            }
       
       
        break;
       
      

        default: 
        $reviewList = buildReviewList($reviews);

        if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) { 
          
          
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/admin.php';
        } else {
          
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/home.php';
        }
            
            break;

        

       
    }


?>