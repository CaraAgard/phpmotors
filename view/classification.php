<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?>

      <?php 
      if(isset($_SESSION['loggedin'])){
        ?>
        <a href="/phpmotors/accounts/?action=logout" class="acc">Logout</a>
        <?php } else { ?>
          <a href="/phpmotors/accounts?action=login-page" class="account" title="Login or Register with PHP Motors" id="acc">My Account</a>
          <?php } ?>
   
      <!--<ul class="navigation">
        <li><a href="/">Home</a></li>
        <li class="classic"><a class="classic_color" href="/">Classic</a></li>
        <li><a href="/">Sports</a></li>
        <li><a href="/">SUV</a></li>
        <li><a href="/">Trucks</a></li>
        <li><a href="/">Used</a></li>
      </ul>-->

    <h1><?php echo $classificationName; ?> vehicles</h1>

    <?php if(isset($message)){
    echo $message; }
    ?>
    <?php if(isset($vehicleDisplay)){
    echo $vehicleDisplay;
    } ?><br>

 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 