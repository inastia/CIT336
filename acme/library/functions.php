<?php

//================== server side validation for email inputs =================
function checkEmail($clientEmail) {
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

//=============== server side validation for password inputs =================
function checkPassword($clientPassword) {
 $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
 return preg_match($pattern, $clientPassword);
}

//========================= dynamic navigation ==========================
function dynamicNavigation() {
 $categories = getCategories();
 // Build a navigation bar using the $categories array
 $navList = '<nav><ul>';
 $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
    $navList .="<li><a href='/acme/products/?action=category&amp;type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>"."\n";
  }
  $navList .='</ul></nav>';
  return $navList;
}

//================== display all products as a list ===============

function buildProductsDisplay($products){
  $pd = '<ul id="prod-display">'."\n";
  foreach ($products as $product) {
    $pd .= '<li>'."\n";
    $pd .= "<a href='/acme/products?action=product-details&id=$product[invId]' title='Click to view this product' style='text-decoration:none;'>"."\n";
    $pd .= '<div>'."\n";
    $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>"."\n";
    $pd .= '</div><!--  -->'."\n";
    $pd .= '<hr>'."\n";
    $pd .= "<h2 style='font-size:22px;'>$product[invName]</h2>"."\n";
    $pd .= "<span>$$product[invPrice]</span>"."\n";
    $pd .= '</a>'."\n";
    $pd .= '</li>'."\n";
  }
  $pd .= '</ul>';
  return $pd;
}

//================== display specific product details ======================
function buildProductInfoDisplay($productInfo){
  $pd = "<h1 style='text-align: center;'>$productInfo[invName]</h1>"."\n";

  $pd .= '<div class="product-display">';
  
  $pd .= '<div class="image-display">';
    $pd .= "<img src='$productInfo[invImage]' alt='An image showing the ACME $productInfo[invName]'>"."\n";
  $pd .= '</div>';
  
  $pd .= '<div class="product-details">';
    $pd .= "<p style='color:#373BB4; font-weight: bold;'>$$productInfo[invPrice]</p>"."\n";
    $pd .= "<p>"."\n";
      if ($productInfo['invStock'] < 10){
        $pd .= "<span>Only $productInfo[invStock] left. Order soon!</span></p>"."\n";
      } else {
        $pd .= "<span>In stock!</span></p>"."\n";
      }
    $pd .= "<p>$productInfo[invDescription]</p>"."\n";
    $pd .= "<p>Size: $productInfo[invSize]</p>"."\n";
    $pd .= "<p>Weight: $productInfo[invWeight] lb</p>"."\n";
    $pd .= "<p>Style: $productInfo[invStyle]</p>"."\n";
  $pd .= '</div>';
  
  $pd .= '</div>'; //product display div ends here 
  

  return $pd;
}

?>