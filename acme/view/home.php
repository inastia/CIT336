<!DOCTYPE html>
<html lang='en-us'>

 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>	
  <nav><?php echo $navList; ?></nav>
  <main>
   <h1> Welcome to ACME!</h1>
   
   <section class="welcome">
    <ul>
     <li><h2>Acme Rocket</h2></li>
     <li>Quick lighting fuse</li>
     <li>NHTSA approved seat belts</li>
     <li>Mobile launch stand included</li>
     <li><a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
    </ul>
   </section>
   
   <div class="one">
   <section class="recipes">
    <h2>Featured Recipes</h2>
    <div class="list">
     <figure>
     <img src="/acme/images/recipes/bbqsand.jpg" alt="bbq">
     <figcaption><a href="">Pulled Roadrunner BBQ</a></figcaption>
     </figure>
     
     <figure>
     <img src="/acme/images/recipes/potpie.jpg" alt="bbq">
     <figcaption><a href="">Roadrunner Pot Pie</a></figcaption>
     </figure>
     
     <figure>
     <img src="/acme/images/recipes/soup.jpg" alt="bbq">
     <figcaption><a href="">Roadrunner Soup</a></figcaption>
     </figure>
     
     <figure>
     <img src="/acme/images/recipes/taco.jpg" alt="bbq">
     <figcaption><a href="">Roadrunner Tacos</a></figcaption>
     </figure>
    </div>
   </section>

   <section class="reviews">
    <h2>ACME Rocket Reviews</h2>
    <ul>
     <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
     <li>"That thing was fast!" (4/5)</li>
     <li>"Talk about fast delivery." (5/5)</li>
     <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
     <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
    </ul>
   </section>
   </div> <!-- div one ends here -->

  </main>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
 </div> <!-- div content ends here -->
 </body>
</html>
