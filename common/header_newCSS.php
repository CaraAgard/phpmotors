<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php if (isset($pageTitle)) {echo $pageTitle; } ?> | phpmotors 
  </title>
  
<link rel="stylesheet" href="/phpmotors/css/homes.css">
  
  
</head>


<body>
<div class="border">
    <header class="header">
        <a href="/phpmotors/" title="logo">
        <img src="/phpmotors/images/photos/logo.png" alt="logo" id="logo">Home Link
       </a><br><br><br><br>
       <!--// if (isset($cookieFirstname)) {
         //echo "<span>Welcome $cookieFirstname</span>";
       //} ?>-->

      <?php 
      if(isset($_SESSION['loggedin'])){
        ?>
        <a href="/phpmotors/accounts/"><h1><?php echo $_SESSION['clientData']['clientFirstname']?></h1>Click name above to see admin view to update and delete after you enter a review.</a><br><br><br>

        <a href="/phpmotors/accounts/?action=logout" class="acc"> LOGOUT HERE</a>
        <?php } else { ?>
          <a href="/phpmotors/accounts?action=login-page" class="account" title="Login or Register with PHP Motors" id="acc">My Account</a>
          <?php } ?>
   
    </header>
    <br>
    <div class="flex">
    <nav>
   
    
    
      <!--<ul class="navigation">
        <li><a href="/">Home</a></li>
        <li class="classic"><a class="classic_color" href="/">Classic</a></li>
        <li><a href="/">Sports</a></li>
        <li><a href="/">SUV</a></li>
        <li><a href="/">Trucks</a></li>
        <li><a href="/">Used</a></li>
      </ul>-->
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>


    </nav>
    </div>

   
        
      
