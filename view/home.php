<?php
$section = 'home';
require('common/header.php'); 
 ?>

<main>
        <h1> Welcome to Acme!</h1>
              <div class="herocontainer">
                  
            <div class="heroad">
            <h1>Acme Rocket</h1>
        Quick lighting fuse<br>
        NHTSA approved seat belts<br>
        Mobile launch stand included<br>
        <br><br>
        <button> I Want It Now! </button>
        </div>
                </div>
          
                <div id="pagebanner"></div>
                <div class="page_content">
              <section>

              <h2>Featured Recipes</h2>
                <div class="food">
        <section><img src="images/recipes/bbqsand.jpg" alt="bbq"> <br> <p>Pulled Roadrunner BBQ </p></section>
        <section><img src="images/recipes/potpie.jpg" alt="potpie"><br>  <p>Roadrunner Pot Pie</p></section>
        <section><img src="images/recipes/soup.jpg" alt="soup"> <br> <p>Roadrunner Soup </p></section>
        <section><img src="images/recipes/taco.jpg" alt="taco"> <br> <p>Roadrunner Tacos</p></section>
        </div>
        </section>
              <section class="reviews">
              <h2> Acme Rocket Review</h2>
        <ul>
        <li>"I don't know ho I ever caught roadrunners before this." (4/5)</li>
        <li>"That thing was fast!" (4/5)</li>
        <li>"Talk about fast delivery." (5/5)</li>
        <li>"I didn't even have to pull the meat apart" (4.5/5)</li>
        <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
        </ul>
              </section>
        </div>
</main>
  <?php
    require('common/footer.php'); 
    ?>