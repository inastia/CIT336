<?php

/*
 * ACME Controller
 */

// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
// Get the functions library
require_once 'library/functions.php';

// Create or access a Session
 session_start();

//$action is a variable used to store the type of content being requested.
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
 if ($action == NULL) {
  $action = 'home';
 }
}

// Get the array of categories
$categories = getCategories();
//Dynamic Nagigation
$navList = dynamicNavigation();

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

//Each case statement represents a different process to execute. 
switch ($action) {
 case 'home':
  include 'view/home.php';
  break;
}
