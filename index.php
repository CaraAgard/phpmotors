<?php

// Create or access a Session

session_start();

//if(isset($_SESSION['Log-In'])){
 // $_SESSION['message'] = "Welcome $clientFirstname. .";   
 //}
    //exit;


   

    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicle-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/uploads-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/accounts-model.php';
    
// Get the database connection file


//Get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
//exit;

$navList = navagationList($classifications);
echo $navList;
 //exit;


// Build a navigation bar using the $classifications array
// $navList = '<ul>';
// $navList .= "<li><a href='/phpmotors/vehicles/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/vehicles/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';
//  echo $navList;
 //exit;
// //$navList = navagationList($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'something':

        break;


        default:
        
         include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
        // case 'cookie':
          //  include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/cookie.php';
         
            break;
}
// Default Page Title
$pageTitle = 'Home ';




?>