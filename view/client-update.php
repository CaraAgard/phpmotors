
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 

<h1>Client Update</h1>
<p>Account Update</p>
<form  method="post" action="/phpmotors/accounts/index.php">
            
            <label for="clientFirstname">First Name</label><br>
            <input type="text" name="clientFirstname" id="clientFirstname" required <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; } elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; }?>><br>
           
            <label for="clientLastname">Last Name</label><br>
            <input type="text" name="clientLastname" id="clientLastname" required <?php if(isset($clientLastname)){ echo "value='$clientLastname'"; } elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; }?>><br>
            
            <label for='email'>Email:</label><br>
            <input type="email" name="clientEmail" id="email" required <?php if(isset($clientEmail)){ echo "value='$clientEmail'"; } elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'"; }?>><br>
           
            <input type="submit" value="Update Client" name="submit" id="regbtn" class="blue">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="AccountUpdate">
            <input type="hidden" name="clientId" value="
            <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
            elseif(isset($clientId)){ echo $clientId; } ?>
            "><br><br><br>
           
        </form>

        <p>Change Password</p>

        <form  method="post" action="/phpmotors/accounts/index.php">
           
            <label for='password'>Password:</label><br>
            <span>Passwords must be at least 8 characters and contain at least 1
              number, 1 capital letter and 1 special character
            </span><br>

            <input type="password" name="clientPassword" id="password" required <?php if(isset($clientPassword)){ echo "value='$clientPassword'"; } elseif(isset($clientInfo['clientPassword'])) {echo "value='$clientInfo[clientPassword]'"; }?> placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
           
            <input type="submit" value="Update Password" name="submit" id="regbtn" class="blue">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="
            <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
            elseif(isset($clientId)){ echo $clientId; } ?>
            "><br><br><br>
           
        </form>

 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 