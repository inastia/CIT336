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
  $navList .= "<li><a href='/acme/index.php?action=" . urlencode($category['categoryName']) . "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul></nav>';
 return $navList;
}

?>