<!DOCTYPE html>
<html lang='en-us'>

 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
  <nav><?php echo $navList; ?></nav>
   
  <main>
   <h1><?php echo $type; ?> Products</h1>
   <?php if(isset($message)){ echo $message; } ?>
   <?php if(isset($productDisplay)){ echo $productDisplay; } ?>
  </main>
 
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
 </div> <!-- div content ends here -->
 </body>
</html>
