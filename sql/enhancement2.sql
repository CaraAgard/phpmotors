--query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

--query 2
UPDATE clients SET clientLevel = 3 WHERE clientLastname = 'Stark';

--query 3
SELECT REPLACE( invDescription, 'small' , 'spacious' )
FROM inventory
WHERE invModel = 'Hummer';

--query 4
SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification ON 
Inventory.classificationID = carclassification.classificationID
WHERE carclassification.classificationName = 'SUV';

--query 5
DELETE
FROM inventory
WHERE
invModel = 'Wrangler' AND  invMake = 'Jeep';

--query 6
UPDATE inventory
SET dir=concat('phpmotors', dir) dir=concat('/phpmotors')
IN invImage AND invThumbnail;  
--(I couldn't figure this one out, and my teammate either.)