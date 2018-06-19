<!DOCTYPE html>
<html lang='en-us'>

 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
   <?php echo $navList; ?>
   <main>

    <?php
    if (isset($message)) {
     echo $message;
    }
    ?>

    <form action="/acme/accounts/index.php" method="post">

     <fieldset>
      <legend>Register</legend>

      <div class="input">
       <label for="name">First Name: </label>
       <input <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>
        type="text" id="firstName" name="clientFirstname" placeholder="Enter your first name" required>
      </div>

      <div class="input">
       <label for="name">Last Name: </label>
       <input <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>
        type="text" id="lastName" name="clientLastname" placeholder="Enter your last name" required>
      </div>

      <div class="input">
       <label for="email">Email: </label>
       <input <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
        type="email" id="email" name="clientEmail" placeholder="Enter your email address" required>
      </div>

      <div class="input">
       <label for="password">Password: </label>
       <input type="password" id="password" name="clientPassword" 
              pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
              placeholder="Enter your password" required>
      </div>

      <div class="button">
       <input type="submit" name ="submit" value="Register" id="register">
      </div>
      
      <!-- Add the action name - value pair to process the registration -->
      <input type="hidden" name="action" value="register">

     </fieldset>
    </form>
    
    <p class="input-help-text">***Passwords must be at least 8 characters and 
       contain at least 1 number, 1 capital letter, and 1 special character</p>

   </main>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
  </div> <!-- div content ends here -->
 </body>
</html>

