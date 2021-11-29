<?php
// Create or access a Session
session_start();
// Get the database connection file
require_once './library/connections.php';
// Get the phpmotors model for use as needed
   require_once './model/main-model.php';
// Get the accounts model
   require_once './model/vehicles-model.php';
// Get the functions model
   require_once './library/functions.php';

 // Get the array of classifications
 $classifications = getClassifications();
 $navList = navigationPopulation($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
 }
 switch ($action){
  case 'something':
  default:
   include './view/home.php';
 }
?>