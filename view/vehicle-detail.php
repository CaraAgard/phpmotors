<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 

      


    <h1> Vehicle Details</h1><br>
    <h4>Vehicle reviews can be seen at the bottom of the page.</h4>
   

    <?php if(isset($message)){
    echo $message; }
    if (isset($_SESSION['loggedin'])){
      $clientId = $_SESSION['clientData']['clientId'];
      $clientFirstname = $_SESSION['clientData']['clientFirstname'];
      $clientLastname = $_SESSION['clientData']['clientLastname'];

    }
    ?>
    <?php if(isset($vehicleDisplayMore)){
    echo $vehicleDisplayMore;
    } ?><br>
    <?php if(isset($reviewDisplay)){
 echo $reviewDisplay;
} else {
  echo "Be the first to write a review.";
}

?><br>

    <h2>Customer Reviews</h2>
    <?php 
    if (!isset($_SESSION['loggedin'])){
      echo "<a href='/phpmotors/accounts/index.php?action=Log-In'><h2>Login to make review Here</h2></a>";
    }
    ?>
   
    <p>If logged in, add review here:</p>
    <form method="POST" action="/phpmotors/reviews/index.php">
    <label for="reviewText">Review</label><br>
  <textarea name="reviewText" id="reviewText" required  <?php if(isset($reviewText)){echo "value='$reviewText'";} ?>></textarea>
  <br><br>
  <input type="submit">
  <input type="hidden" id="invId" name="invId" value="<?php if(isset($invId)){ echo $invId; } ?>">
  <input type="hidden" id="clientId" name="clientId" value="<?php if(isset($clientId)){ echo $clientId; } ?>">
  <input type="hidden" name="action" value="review">
</form><br><br><br>
<?php echo $listOFClientRevs;?>
   
 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
 <?php unset($_SESSION['message']); ?>