<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 
 
<h1>Edit a Review</h1>
<br>
    

    <?php if(isset($message)){
    echo $message; }
    $reviewText = $revInfo['reviewText'];
    
   
    ?>
    
   

<form method="POST" action="/phpmotors/reviews/index.php" id="reviewForm">
  <textarea name="reviewText" id="reviewText" required ><?php  if (isset($reviewText)) {echo $reviewText;} ?></textarea><br><br> 
  <input type="submit" name="submit" value="Update Review">
  <input type="hidden" name="action" value="handle_review_update">
  <input type="hidden" name="reviewId" value="<?php  if (isset($reviewId)) {echo $reviewId;}?>">
</form><br><br><br>

 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
 