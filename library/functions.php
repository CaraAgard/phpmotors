<?php
function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }



function checkClassificationNameLength($classificationName){
    $pattern = '\d[1,30]';
    return preg_match($pattern, $classificationName);
   }


//trying to return navagation with a function
function navagationList($classifications){
    $navList = '<ul>';
//$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
$navList .= "<li><a href='/phpmotors/'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
 .urlencode($classification['classificationName']).
 "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
 
}
$navList .= '</ul>';
return $navList;
}
//<a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a>
// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }


   // Build the client select list 
function buildClientList($clients){ 
    $clientList = '<select name="clientId" id="clientList">'; 
    $clientList .= "<option>Choose a Client</option>"; 
    foreach ($clients as $client) { 
     $clientList .= "<option value='$client[clientId]'>$client[clientFirstname]</option>"; 
    } 
    $clientList .= '</select>'; 
    return $clientList; 
   }
   


   function buildPassword($passwords){ 
    $passwordList = '<select name="clientId" id="clientList">'; 
    $passwordList .= "<option>Choose a password</option>"; 
    foreach ($passwords as $password) { 
     $passwordList .= "<option value='$password[clientId]'>$password[clientPassword]</option>"; 
    } 
    $passwordList .= '</select>'; 
    return $passwordList; 
   }

   //new function will build a display of vehicles within an unordered list.
   function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleStats&invId="
     .urlencode($vehicle['invId']).
     "' title='View our $vehicle[invId] lineup of vehicles'>$vehicle[invId]";
    
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</a>';
     $dv .= '<h3>Reviews</h3>';
     

     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

   //revs
   function buildVehiclesInfo($info, $getRVs){
       
      $dv = "<img src='$info[invImage]' alt='Image of $info[invMake] $info[invModel] on phpmotors.com'>";
      $dv .= '<hr>';
      $dv .= "<h2>$info[invMake] $info[invModel]</h2>";
      $dv .= "<h4>$info[invDescription] $info[invImage]</h4>";
      $dv .= "<h3>$info[invColor]</h3>";
      $dv .= "<span><strong> $ $info[invPrice].00</strong></span><br><br><br><br>";
      $dv .= '</li>';  
      $dv .= '</ul>';
      $dv .= '<div/>';
      $dv .= "<h3>Cars Reviewed</h3>";
      
      $dv .= "<h3>$getRVs[reviewDate]</h3>";
      $dv .= "<h3>" . substr($getRVs['clientFirstname'], 0, 1) . "</h3>";
      $dv .= "<h3>$getRVs[clientLastname]</h3>";
      $dv .= "<h3>$getRVs[reviewText]</h3></div>";


      // rsort($getRVs);
      // foreach ($getRVs as $rv) {
      // $dv .= "<h3>$rv[reviewDate]</h3>";
      // $dv .= "<h3>" . substr($rv['clientFirstname'], 0, 1) . "</h3>";
      // $dv .= "<h3>$rv[clientLastname]</h3>";
      // $dv .= "<h3>$rv[reviewText]</h3></div>";
       //}
      return $dv;
   }


  
/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }



// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }




// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

   function getPlacedDate($revInfo){
    $Date = date('d F, Y',strtotime($revInfo['reviewDate']) );
    return $Date;
  }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    // case IMAGETYPE_JPEG:
    //  $image_from_file = 'imagecreatefromjpeg';
    //  $image_to_file = 'imagejpeg';
    // break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function
  


  
// Build the classifications select list 
function buildReviewList($clientReviews){ 
   
    $reviewList = '<h3>Review Options</h3>'; 
    $reviewList .= '<ul>'; 
    foreach ($clientReviews as $review) {   
     $reviewList .= '<li>' .'Date of Review'. '<br>'.$review['reviewDate']. '<br><br>'. 'Review text'.'<h2>' . $review['reviewText']. '</h2>'. '<br><br>';
     $reviewList .= "<a href='/phpmotors/reviews/?action=mod&reviewId=$review[reviewId]'><h3>Change a Review</h3></a><br>";
     $reviewList .= "<a href='/phpmotors/reviews/?action=deliver_view_to_delete&reviewId=$review[reviewId]'><h3>Delete</h3></a></li><br><br><br>";
     
   }
   $reviewList.= "</ul>";
   return $reviewList;
  }

   function getName($clientFirstname){
    $clientName = getClient($clientFirstname);
    return $clientName;
  }
  



 
?>

   


