<!DOCTYPE html>
<html lang='en-us'>

 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/head.php'; ?>

 <body>
  <div class="content">
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
      <?php echo $navList; ?>
   <main>
    <!--message returned from the controller-->
    <?php
    if (isset($message)) {
     echo $message;
    }
    ?> 
    <section class="categoryForm">
     <!--the data is sent to the products controller-->
     <form  method="post" action="/acme/products/index.php">

      <fieldset>
       <legend>Add Category</legend>

       <div class="input">
        <label for="categoryName">New Category Name:</label>
        <input <?php if(isset($categoryName)){echo "value='$categoryName'";} ?>
               type="text" name="categoryName" id="categoryName"  
               pattern="[a-zA-Z0-9]{3,99}" required>
       </div>

       <div class="button">
        <input type="submit" name="submit" value="Add Category" id="newCategory">      
       </div>

       <!-- Add the action name - value pair to process the category input -->
       <input type="hidden" name="action" value="newCat">  

      </fieldset>  

     </form>
    </section>
   </main>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
  </div> <!-- div content ends here -->
 </body>
</html>



