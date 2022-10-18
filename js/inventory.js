'use strict' 
 
 // Get a list of vehicles in inventory based on the classificationId 
 let classificationList = document.querySelector("#classificationList"); 
 classificationList.addEventListener("change", function () { 
  let classificationId = classificationList.value; 
  console.log(`classificationId is: ${classificationId}`); 
  let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId; 
  fetch(classIdURL) 
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) { 
   console.log(data); 
   buildInventoryList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message) 
  }) 
 })

 // Build inventory items into HTML table components and inject into DOM 
function buildInventoryList(data) { 
    let inventoryDisplay = document.getElementById("inventoryDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
     console.log(element.invId + ", " + element.invModel); 
     dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable; 
   }



   // Get a list of clients in clients based on the clientId 
 let clientList = document.querySelector("#clientList"); 
 clientList.addEventListener("change", function () { 
  let clientId = clientList.value; 
  console.log(`clientId is: ${clientId}`); 
  let clientIdURL = "/phpmotors/accounts/index.php?action=getClientItems&clientId=" + clientId; 
  fetch(clientIdURL) 
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) { 
   console.log(data); 
   buildClientList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message) 
  }) 
 })


 // Build client items into HTML table components and inject into DOM 
function buildClientList(data) { 
    let clientDisplay = document.getElementById("clientDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Client Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
     console.log(element.clientId + ", " + element.clientFirstname); 
     dataTable += `<tr><td>${element.clientLastname} ${element.clientEmail}</td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=modclient&clientId=${element.clientId}' title='Click to modify'>Modify</a></td>`; 
    
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    clientDisplay.innerHTML = dataTable; 
   }

   //review stuff
   'use strict' 
 
 // Get a list of vehicles in inventory based on the clientId 
 let reviewList = document.querySelector("#reviewList"); 
 reviewList.addEventListener("change", function () { 
  let clientId = reviewList.value; 
  console.log(`clientId is: ${clientId}`); 
  let clientIdURL = "/phpmotors/reviews/index.php?action=getReviewItems&clientId=" + clientId; 
  fetch(clientIdURL) 
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) { 
   console.log(data); 
   buildInventoryList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message) 
  }) 
 })
 
 
 // Build inventory items into HTML table components and inject into DOM 
function buildReviewList(data) { 
  let reviewDisplay = document.getElementById("reviewDisplay"); 
  // Set up the table labels 
  let dataTable = '<thead>'; 
  dataTable += '<tr><th> Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
  dataTable += '</thead>'; 
  // Set up the table body 
  dataTable += '<tbody>'; 
  // Iterate over all vehicles in the array and put each in a row 
  data.forEach(function (element) { 
   console.log(element.reviewId + ", " + element.reviewText); 
   dataTable += `<tr><td>${element.revDate} ${element.invId}</td>`; 
   dataTable += `<td><a href='/phpmotors/reviews?action=mod&reviewId=${element.reviewId}' title='Click to modify'>Modify</a></td>`; 
   dataTable += `<td><a href='/phpmotors/reviews?action=del&reviewId=${element.reviewId}' title='Click to delete'>Delete</a></td></tr>`; 
  }) 
  dataTable += '</tbody>'; 
  // Display the contents in the Vehicle Management view 
  reviewDisplay.innerHTML = dataTable; 
 }