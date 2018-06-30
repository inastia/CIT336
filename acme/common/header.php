<?php
if (isset($_SESSION['loggedin'])) {
$clientFirstname = $_SESSION['clientData']['clientFirstname'];
}
?>
<header>
 
 <div class="header">
  <a href="/acme/">
   <img id="logo" src="/acme/images/site/logo.gif" alt="The site logo">
  </a>

  <div class="red">
   <?php
    if (isset($_SESSION['loggedin'])) {
     //if logged in display welcome message, name, option to log out
    echo "<p><a href='/acme/accounts/index.html'>Welcome, $clientFirstname </a> <img id='red' src='/acme/images/site/account.gif' alt='The red folder'> <a href='/acme/accounts/index.php?action=logout's>Logout</a></p>";
   } else {
    //if not logged in, display the red folder and the My Account text
    echo "<img id='red' src='/acme/images/site/account.gif' alt='The red folder'><p><a href='/acme/accounts/index.php?action=login'>My Account</a></p>";
   }
   ?>
  </div> <!-- div class red ends here -->

 </div>
 
</header>

