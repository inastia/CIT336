<?php
if (!$_SESSION['loggedin']) {
 header('Location: /acme/accounts/');
}
?>
<!DOCTYPE html>
<html lang='en-us'>

 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
  <?php echo $navList; ?>
   
  <main>
   <h1><?php echo $_SESSION['clientData']['clientFirstname']; ?></h1>
    <p><a href="/acme/accounts/">&#8592; Back to account</a></p>
    
    <section>
    
      <?php if (isset($message)) {echo $message;} ?>
      <form method="post" action="/acme/accounts/" >
       
       <fieldset>
        
        <legend>Update name &amp; email</legend>
        
        <div class="input">
        <label for="clientFirstname">First Name</label>
        <input <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>
               id="clientFirstname"
               name="clientFirstname"
               placeholder="Enter your first name.."
               required
               type="text">
        </div>
        
        <div class="input">
        <label for="clientLastname">Last Name</label>
        <input <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>
               id="clientLastname"
               name="clientLastname"
               placeholder="Enter your last name.."
               required
               type="text">
        </div>
        
        <div class="input">
        <label for="clientEmail"> Your Email</label>
        <input <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
               id="clientEmail"
               name="clientEmail"
               placeholder="Enter your email address.."
               required
               type="email">
        </div>

        <div class="button">
         <input name="submit" type ="submit" value="Update my info" >
        </div>
        
        <input name="action" type="hidden" value="updateClientInfo" >
        <input name="clientId"
               type="hidden"
               value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">

        
        </fieldset> 
      </form>
    </section>
    
    <section>
      
      <?php if (isset($passwordMessage)) {echo $passwordMessage;} ?>
      <form method="post" action="/acme/accounts/">
       <fieldset>
        
        <legend>Update password</legend>
        
        <div class="input">
        <label for="clientPassword">New Password *</label>
        <input id="clientPassword"
               name="clientPassword"
               pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
               placeholder="Enter a new password"
               required
               type="password">
        </div>

        <div class="button">
        <input name="submit" type="submit" value="Update my password" >
        </div>

        <input name="action" type="hidden" value="updateClientPassword" >
        <input name="clientId"
               type="hidden"
               value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
       </fieldset>
       <p style="color: red;">Note: Submitting this form will change your password!</p>
      </form>
      <p>* Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</p>
    </section>


  </main>
   
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
 </div> <!-- div content ends here -->
 </body>
</html>

