<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header_newCSS.php'; ?>



<a href="/phpmotors/accounts?action=admin"> <?php  if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];}?></a>
<h1>
          Welcome to PHP Motors!
        </h1>
        <aside>
        <h2>DMC Delorean</h2>
        <p>3 Cup holders</p>
        <p>Superman doors</p>
        <p>Fuzzy Dice!</p>
        </aside>
        <img class="car" src="/phpmotors/images/vehicles/delorean.jpg" alt="delorean">
        <button class="own">Own Today</button>
        <section class="middle">
        <section reviews>
            <h2>DMC Delorean Reviews</h2>
   
                <p>. "So fast it's almost like traveling in time." (4/5)</p>
                <p>. "Coolest ride on the road." (4,5)</p>
                <p>. "I'm feeling Marty McFly!" (5/5)</p>
                <p>. "The most futuristic ride of our day." (4/5)</p>
                <p>. "80s livin and I love it!" (5/5)</p>
            
        </section>
        <section class="stuff">
            <section class="upgrades">
           
           
                <h2>Delorean Upgrades</h2>
                <div class="select">
                <div class="option">
                    <a href="#" class="blue">     
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux cap">      
                    </a>
                    <p>Flux Capacitor</p>
                </div>
                <div class="option">
                    <a href="#" class="blue">     
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame">      
                    </a>
                    <p>Flame Decals</p>
                </div>
                <div class="option">
                    <a href="#"class="blue">     
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper sticker" >      
                    </a>
                    <p>Bumper Stickers</p>
                </div>
                <div class="option">
                    <a href="#"class="blue">     
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub cap">      
                    </a>
                    <p>Hub Caps</p>
                </div><br><br><br><br>
                
                </div>

            </div>
         
            </section>
        </section>
</section><br><br><br><br><br>

      


 <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
