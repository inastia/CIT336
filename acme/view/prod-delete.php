<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
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

    <h1>
     <?php
     if (isset($productInfo['invName'])) {
      echo "Delete $productInfo[invName]";
     } elseif (isset($invName)) {
      echo $invName;
     }
     ?>
    </h1>

    <!-- message returned from the controller -->
    <?php
    if (isset($message)) {
     echo $message;
    }
    ?> 
    <p>Are you sure you want to delete the product?</p>

    <section class="productForm">
     <!--the data is sent to the products controller-->
     <form  method="post" action="/acme/products/index.php">

      <fieldset>
       <legend>Update Product</legend>

       <div class="input">
        Category: 
        <?php echo $catList; ?>
       </div>

       <div class="input">
        <label for="invName">Product Name:* </label>
        <input <?php if (isset($invName)) {
         echo "value='$invName'";
        } elseif (isset($productInfo['invName'])) {
         echo "value='$productInfo[invName]'";
        }
        ?>
         type="text" 
         name="invName">
       </div>

       <div class="input">
        <label for="invDescription">Product Description:*</label>
        <textarea 
         name="invDescription"
         placeholder="Enter description" >
        <?php if (isset($invDescription)) {
         echo $invDescription;
        } elseif (isset($productInfo['invDescription'])) {
         echo $productInfo[invDescription];
        }
        ?>
        </textarea>
       </div>


       <div class="button">
        <input type="submit" name="submit" value="Delete Product">        
       </div>

       <!-- Add the action name - value pair to process the new product name -->
       <input type="hidden" name="action" value="deleteProduct">
       
       <input name="invId"
              type="hidden"
        value="<?php
        if (isset($productInfo['invId'])) {
         echo $productInfo['invId'];
        } elseif (isset($invId)) {
         echo $invId;
        }
        ?>">
      </fieldset>  

     </form>
    </section>
   </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
  </div> <!-- div content ends here -->
 </body>
</html>



