
<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
  
  <link rel="stylesheet" href="/phpmotors/css/home.css">
  
</head>
<div class="border">

<body>
  
    <header class="header">
        <a href="/" title="logo">
        <img src="/phpmotors/images/photos/logo.png" alt="logo">
       </a>
       <? if (isset($cookieFirstname)) {
         echo "<span>Welcome $cookieFirstname</span>";
       } ?>

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

    <main>
    <h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
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
<p>Confirm Vehicle Deletion. The delete is permanent.</p>


<form method="post" action='/phpmotors/vehicles/'>
    <label for="carClass">Classification</label><br>
    <?php echo $classificationList; ?> <br>
<br>
    <label for="invMake">Make</label><br>
	<input type="text" readonly name="invMake" id="invMake" <?php
    if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>

    <label for="invModel">Model</label><br>
	<input type="text" readonly name="invModel" id="invModel" <?php
    if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
     
    <label for="invDescription">Description</label><br>  
	<textarea name="invDescription" readonly id="invDescription"><?php
    if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
    ?></textarea><br>

    <input type="submit" name="submit" value="Delete Vehicle"><br>
    <input type="hidden" name="action" value="deleteVehicle">
	<input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
    echo $invInfo['invId'];} ?>"><br><br><br>
    

</form>



 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>