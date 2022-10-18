<?php 
/*
*Insert a review
*Get review for specficic inventory item
*Get reviews written by a specific client
*Get a specific review
*Update a specific review
*Delete a specific review
*/

   
//Reviews model


function insertReview($reviewText, /*$reviewDate,*/ $invId, $clientId) {
     // Create a connection object using the phpmotors connection function
     $db = phpmotorsConnect();
     // The SQL statement
     $sql = 'INSERT INTO reviews (reviewText, /*reviewDate,*/ invId, clientId)
         VALUES (:reviewText, /*:reviewDate,*/ :invId, :clientId)';
     // Create the prepared statement using the phpmotors connection
     $stmt = $db->prepare($sql);
     // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
   // $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
    

}



   //Get review information by invId
function inventoryItemReview( $invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviews.reviewText, reviews.reviewDate, reviews.clientId,
    clients.clientId, clients.clientFirstname, clients.clientLastname
    FROM reviews 
    INNER JOIN clients ON reviews.clientId = clients.clientId
    WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewInfo;
   }




function updateSpecificReview($reviewId, $reviewText) {
    
    $db = phpmotorsConnect();
        $sql = 'UPDATE reviews SET  reviewText = :reviewText   
         WHERE reviewId  = :reviewId'; 
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute(); 
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged; 

}




function deleteSpecificReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;

}


// Get reviews by clientId 
function getReviewsByClient($clientId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM reviews WHERE clientId = :clientId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviewInfo = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviewInfo; 
   }

   
  

  // Get vehicle information by invId
function getRevStuff($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $revInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $revInfo;
   }


  
   function carInformation($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }




?>