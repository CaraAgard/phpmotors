<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 
 
<h1>Delete a Review</h1>
<br>
    <p>WARNING this is permanante.</p>

    <?php if(isset($message)){
    echo $message; }
    $reviewText = $revInfo['reviewText'];
    
   
    ?>
    
   

<form method="POST" action="/phpmotors/reviews/index.php" id="deleteForm">
  <textarea name="reviewText" id="reviewText" readonly ><?php  if (isset($reviewText)) {echo $reviewText;} ?></textarea><br><br> 
  <input type="submit" name="submit" value="Delete Review">
  <input type="hidden" name="action" value="handle_review_delete">
  <input type="hidden" name="reviewId" value="<?php  if (isset($reviewId)) {echo $reviewId;}?>">
</form><br><br><br>

 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
 