
<?php 
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];

}

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?>


<h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'];?>
</h1>
<p><strong>You are logged in.</strong></p>
<a href="/phpmotors/accounts?action=clientUpdate" class="account"  id="acc"><strong>Update Account Information Here</strong></a><br>
<?php
if ($_SESSION['clientData']['clientLevel'] < 1) {
  echo '<h2>Use link to administer inventory.</h2>'; 
  echo '<a href="/phpmotors/vehicles?action=vehicle_management" class="account" ><strong>Update Vehicle Information Here</strong></a><br>';
 exit;
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
 }




?>
<noscript>
<table id="clientDisplay"></table>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<?php
if (isset($message)) { 
 echo $message; 
} 

?>


<ul>
  <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
  <label for='clientFirstname'>First Name:</label>
  <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
  <label for='clientLastname'>Last Name:</label>
  <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
  <label for='clientEmail'>Email:</label>

</ul><br><br><br>
 <?php echo $listOFClientRevs;?>


<script src="../js/inventory.js"></script>
 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
 <?php unset($_SESSION['message']); ?>
