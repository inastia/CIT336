<?php
if (!$_SESSION['loggedin']) {
 header('Location: /acme/');
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
    <h1>Welcome, <?php echo $_SESSION['clientData']['clientFirstname']; ?></h1>
    <?php if (isset($message)) {echo $message;} ?>
    <p>You are logged in. Here are your account details:</p>
    
    <ul class="">
      <li><strong>Name:</strong> <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
      <li><strong>Last Name:</strong> <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
      <li><strong>Email:</strong> <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
    </ul>
    
   <a href="/acme/accounts/index.php?action=update">Update Account Information</a>

     <?php
     if ($_SESSION['clientData']['clientLevel'] > 1) {
      echo '<hr />
             <h2>Admin Tools</h2>
             <p>To add, edit and delete products, use the link below.</p>
             <p><a href="/acme/products/index.php">Manage Products</a></p>';
     }
     ?>
   

   </main>
   
   
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
   
  </div> <!-- div content ends here -->
 </body>
</html>
