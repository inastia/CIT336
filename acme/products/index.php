<?php

/*
 * Products Controller 
 */

// Get the database connections file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
//Get the products model
require_once '../model/products-model.php';
// Get the functions library
require_once '../library/functions.php';
// Create or access a Session
session_start();
// Get the array of categories
$categories = getCategories();
//Dynamic Nagigation
$navList = dynamicNavigation();
//$action is a variable used to store the type of content being requested.
//function that sifts the content to eliminate code that could do the website harm
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}
$page_title = 'Inventory';

switch ($action) {
 case'catForm':
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-cat.php';
  break;

 case 'prodForm':
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-prod.php';
  break;

 //new product option in the prod-mgmt.php
 case 'newProd':
  //echo '<pre>' . print_r($_POST, true) . '</pre>';
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
  $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
  $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

  //Check for missing data
  if (empty($invName) || empty($invDescription) || empty($invImage) ||
          empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
          empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) ||
          empty($invStyle)) {
   $message = '<p>Please provide information for all empty form fields.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-prod.php';
   exit;
  }
  // Send the data to the model
  $newProductOutcome = newProd($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);
  // Check and report the result
  if ($newProductOutcome === 1) {
   $message = "<p>Thank you. The product has been added to the inventory.</p>";
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-prod.php';
   exit;
  } else {
   $message = "<p>Sorry, new product was not created. Please try again.</p>";
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-prod.php';
   exit;
  }
  break;


 // new category option in the prod-mgmt.php
 case 'newCat':
  // Filter and store the data
  $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
  //Check for missing data
  if (empty($categoryName)) {
   $message = '<p>Please provide information for all empty form fields.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-cat.php';
   exit;
  }
  //Send data to the model
  $newCategoryOutcome = newCat($categoryName);
  //Check and report the result
  if ($newCategoryOutcome === 1) {
   header("location: /acme/products/index.php");
   exit;
  } else {
   $message = '<p class="form-error">Sorry, new category was not created. Please try again.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-cat.php';
   exit;
  }
  break;


 case 'mod':
  $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $productInfo = getProductInfo($invId);
  
  if (count($productInfo) < 1) {
   $message = 'Sorry, no product information could be found.';
  }
  
  if(isset ($prodInfo['invName'])) {
   $page_title = "Modify $prodInfo[invName]";
  } elseif (isset($invName)) {
   $page_title = $invName;
  }
  
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-update.php';
  exit;
  break;


 case 'updateProduct':
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
  $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
  $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

  if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
   $message = '<p>All fields are required.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/prod-update.php';
   exit;
  }
  //send the data to the model
  $updateResult = updateProduct($invId, $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);

  //check and report the result
  if ($updateResult) {
   $message = "<p>$invName has been updated!</p>";
   $_SESSION['message'] = $message;
   header('location: /acme/products/');
   exit;
  } else {
   $message = "<p class='notice'>Error. $invName was not updated.</p>";
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/prod-update.php';
   exit;
  }
  break;



 case 'del':
  $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $productInfo = getProductInfo($invId);
  if (count($productInfo) < 1) {
   $message = 'Sorry, no product information could be found.';
  }
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-delete.php';
  exit;
  break;



 case 'deleteProduct':
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  //send the data to the model
  $deleteResult = deleteProduct($invId);
  //check and report the result
  if ($deleteResult) {
   $message = "<p>$invName has been deleted!</p>";
   $_SESSION['message'] = $message;
   header('location: /acme/products/');
   exit;
  } else {
   $message = "<p>Something didn't work quite right. Product was not deleted. Try again.</p>";
   $_SESSION['message'] = $message;
   header('location: /acme/products/');
   exit;
  }
  break;
  
  
  
  
 case 'category':
 $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
 $products = getProductsByCategory($type);
 if(!count($products)){
   $message = "<p>Sorry, no $type products could be found.</p>";
 } else {
   $productDisplay = buildProductsDisplay($products);
 }  
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/category.php';
 break;
 
 
 


 case 'product-details':
  $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $productInfo = getProductInfo($invId);
  //$productThumbnails = getProductThumbnails($invId);
  
  if(count($productInfo) < 1){
    $message = "<p>Sorry, the product info could not be found.</p>";
  } else {
    $productDisplay = buildProductInfoDisplay($productInfo);
    //$thumbnailDisplay = buildThumbnailDisplay($productThumbnails);
  }

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-details.php';
  
  break;
 
 



 default:
  $products = getProductBasics();
  if (count($products) > 0) {
   $prodList = '<table>';
   $prodList .= '<tbody>';
   foreach ($products as $product) {
    $prodList .= "<tr><td>$product[invName]</td>";
    $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
    $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
   }
   $prodList .= '</tbody></table>';
  } else {
   $message = '<p>Sorry, no products were returned.</p>';
  }

  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/prod-mgmt.php';
  break;
}

