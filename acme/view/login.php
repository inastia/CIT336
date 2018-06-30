<!DOCTYPE html>
<html lang='en-us'>

 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
   <?php echo $navList; ?>
   
   <main>
    <div class="subcontent">
     <?php
     if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
     }
     ?>
     <form action="/acme/accounts/index.php" method="post">
      <fieldset>
       <legend>Log In</legend>

       <div class="input">
        <label for="email">Email: </label>
        <input <?php if (isset($clientEmail)) {
      echo "value='$clientEmail'";
     } ?>
         type="email" id="email" name="clientEmail" placeholder="Enter your email address" required>
       </div>

       <div class="input">
        <label for="password">Password: </label>
        <input 
         type="password" id="password" name="clientPassword" 
         pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
         placeholder="Enter your password" required>
       </div>

       <div class="button">
        <input type="submit" value="LogIn" id="login">
       </div>


       <!-- Add the action name - value pair to process logging in -->
       <input type="hidden" name="action" value="login">

      </fieldset>
     </form>

     <p class="input-help-text">***Passwords must be at least 8 characters and 
      contain at least 1 number, 1 capital letter, and 1 special character.</p>

     <p class="login-p">Don't have an account yet? <a href="/acme/accounts/index.php?action=register">Sign Up Here!</a></p>
    </div> <!-- div class sub content ends here -->
    
   </main>
   
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
  </div> <!-- div content ends here -->
 </body>
</html>
