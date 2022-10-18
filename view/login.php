<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?> 




        <h1>
          Login
        </h1>
        
       <a href="/phpmotors/accounts?action=admin"> <?php  if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];}?></a>
        
        <form action="/phpmotors/accounts/index.php" method="post">
            <label for='email'>Email:</label><br>
            <span>Passwords must be at least 8 characters and contain at least 1
              number, 1 capital letter and 1 special character
            </span><br>
            <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> placeholder="Email Address" required ><br>
            <label for='password'>Password:</label><br>
            <input type="password" id="password" name="clientPassword"   placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br><br>
            <input type="submit" value="Sign-In" class="sign">
            <input type="hidden" name="action" value="Log-In">
            
        </form>
        
        <br>
        <p ><a href="/phpmotors/accounts/?action=deliverRegisterView" id="toReg" class="color">Not a Member Yet?</a></p><br><br>
        
       

        <hr>
       
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 