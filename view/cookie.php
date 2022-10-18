<!DOCTYPE html>
<?php
$name = "flower";
$value = "orchid";
setcookie($name, $value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
     <style>
          * {
               font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
               font-size: 30px;
               color: green;
          }
          p {
               color: blue;
               font-size: 20px;
          }
     </style>
<body>

<?php
if(!isset($_COOKIE[$name])) {
     echo "Reload page to create cookie named: '" . $name;
} else {
     echo "The cookie named '" . $name . "' had been created for one day.<br>";
     echo "The value is: " . $_COOKIE[$name] . ".";
}
// To Delete a Cookie:
//  setcookie($name, $value, time() + (-86400 * 30), "/"); 
?>
<p>Delete Cookie by putting a - in front of the time.</p>
<p>Like: setcookie($name, $value, time() + (-86400 * 30), "/");</p>
 <input type="hidden" value="cookie">
 
<html>
<body>




</body>
</html>