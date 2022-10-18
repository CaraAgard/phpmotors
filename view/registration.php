<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 
<?php echo $navList; ?>
  
    

    
        <h1>
          Register
        </h1>

        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>

        


        <form  method="post" action="/phpmotors/accounts/index.php">
            <label for="clientFirstname">First Name</label><br>
            <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
            <label for="clientLastname">Last Name</label><br>
            <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
            <label for='email'>Email:</label><br>
            <input type="email" id="email" name="clientEmail"  placeholder="Email Address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
            <label for='password'>Password:</label><br>
            <span>Passwords must be at least 8 characters and contain at least 1
              number, 1 capital letter and 1 special character
            </span>
            <input type="password" id="password" name="clientPassword"   placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
            <input type="submit" value="Register" name="submit" id="regbtn" class="blue">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="register"><br><br><br>
           
        </form>
        

        <hr>
      
       
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 