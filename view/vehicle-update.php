
<?php

?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
  <link rel="stylesheet" href="/phpmotors/css/motor.css">
  <link rel="stylesheet" href="/phpmotors/css/home.css">
  
</head>
<div class="border">

<body>
  
    <header class="header">
        <a href="/" title="logo">
        <img src="/phpmotors/images/photos/logo.png" alt="logo">
       </a>
      
      <?php 
      if(isset($_SESSION['loggedin'])){
        ?>
        <a href="/phpmotors/accounts/?action=logout" class="acc">Logout</a>
        <?php } else { ?>
          <a href="/phpmotors/accounts?action=login-page" class="account" title="Login or Register with PHP Motors" id="acc">My Account</a>
          <?php } ?>
   
    </header>
    <br>
    <div class="flex">
    
    </div>

    <main><//?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 
    <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	       echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
         elseif(isset($invMake) && isset($invModel)) { 
	       echo "Modify$invMake $invModel"; }?></h1>
<?php

// Build the classifications option list
$classificationList = '<select name="classificationId" id="classificationId">';
$classificationList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'";
 if(isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
    $classificationList .= ' selected ';
  }
 } elseif(isset($invInfo['classificationId'])){
 if($classification['classificationId'] === $invInfo['classificationId']){
  $classificationList .= ' selected ';
 }
}
$classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?>
<?php echo $navList; ?>


<h1>Modify Vehicle</h1>

<?php
if (isset($message)) {
        echo $message;
}
?>

<p ><a href="/phpmotors/vehicles/?action=vehicle_management" id="toReg" class="color">Vehicle Management</a></p>


<form method="post" action='/phpmotors/vehicles/'>
    <label for="carClass">Classification</label><br>
    <?php echo $classificationList; ?> <br>
<br>
    <label for="invMake">Make</label><br>
    <input type="text" name="invMake" id="invMake" required
    <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>

    <label for="invModel">Model</label><br>
    <input type="text" name="invModel" id="invModel"required
    <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
     
    <label for="invDescription">Description</label><br>
    <textarea name="invDescription" id="invDescription" required>
    <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

    <label for="invImage">Image Path</label><br>
    <input type="text" name="invImage" id="invImage"required
    <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?> value='/phpmotors/images/no-image.png'><br>

    <label for="invThumbnail">Thumbnail</label><br>
    <input type="text" name="invThumbnail" id="invThumbnail"required
    <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?> value='/phpmotors/images/no-image.png'><br>

    <label for="invPrice">Price</label><br>
    <input type="number" name="invPrice" id="invPrice"required
    <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br>

    <label for="invStock">In Stock</label><br>
    <input type="number" name="invStock" id="invStock"required
    <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br>

    <label for="invColor">Color</label><br>
    <input type="text" name="invColor" id="invColor"required
    <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br>
    
    <input type="submit" name="submit" value="Update Vehicle"><br>
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="
    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
    elseif(isset($invId)){ echo $invId; } ?>
    "><br><br><br>

</form>



 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>