<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang='en-us'>
 <!-- head -->
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
   <!-- header -->
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
   <!-- navigation -->
   <nav><?php echo $navList; ?></nav>

   <main>

    <h1>Manage Products</h1>
    <h2 class="welcomeMessage">Welcome to the product management page. Pick one of the following options.</h2>

    <?php
    if (isset($message)) {
     echo $message;
    }
    ?>

    <section class="manageProducts">
     <a href='/acme/products/index.php?action=prodForm'>Add a new product</a><br>
     <a href='/acme/products/index.php?action=catForm'>Add a new category</a>
    </section>
    
     <?php
     if (isset($message)) {
      echo $message;
     } if (isset($prodList)) {
      echo $prodList;
     }
     ?>
    
   </main>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
  </div> <!-- div content ends here -->
 </body>
</html>
<?php unset($_SESSION['message']); ?>

