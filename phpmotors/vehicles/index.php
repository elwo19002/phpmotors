<?php
// Create or access a Session
session_start();
// Get the database connection file
   require_once '../library/connections.php';
// Get the phpmotors model for use as needed
   require_once '../model/main-model.php';
// Get the accounts model
   require_once '../model/vehicles-model.php';
// Get the functions model
   require_once '../library/functions.php';

// Get the array of classifications
 $classifications = getClassifications();
 $navList = navigationPopulation($classifications);

// Build a classification list for dynamic drop-down select list
$classificationList = "<select name='classificationId' id='classificationId'>";
$classificationList .= "<option value='' selected disabled>Choose classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value=".$classification['classificationId'].">".$classification['classificationName']."</option>";
}
$classificationList .= "</select>";

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
  case 'addClass':
    // Filter and store the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
    // Check for missing data
    if (empty($classificationName)){
      $message = '<p>All fields were not completed, please try again.</p>';
      include '../view/add-classification.php';
      exit; 
    }
    // Send the data to the model
    $addClass = addClass($classificationName);
    // Check and report the result
    if($addClass === 1) {
      header ('Location: ../vehicles/index.php');
      include '../view/editInfo.php';
      exit;
    } else {
      $message = '<p The classification could not be added, please try again.</p>';
      include '../view/add-classification.php';
      exit;
    }
    break;

  case 'addVehicle':
    // Filter and store the data
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
    
    // Check for missing data
    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
      $message = '<p>All fields were not completed, please try again.</p>';
      include '../view/add-vehicle.php';
      exit; 
    }
    // Send the data to the model
    $AddVehicleOutcome = addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);
    // Check and report the result
    if($AddVehicleOutcome === 1) {
      $message = "<p>The vehicle was successfully added!</p>";
      include '../view/vehicle-management.php';
      exit;
    } 
    else {
      $message = '<p>The vehicle could not be added, please try again.</p>';
      include '../view/addVehicle.php';
      exit;
    }
    break;

  /* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */ 
  case 'getInventoryItems': 
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray); 
    break; 

  case 'mod':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo)<1){
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;
    
  case 'updateVehicle':
	$classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
	$invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
	$invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
	$invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
	$invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
	$invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
	$invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
	$invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
	$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
	
	if (empty($classificationId) || empty($invMake) || empty($invModel) 
    || empty($invDescription) || empty($invImage) || empty($invThumbnail)
    || empty($invPrice) || empty($invStock) || empty($invColor)) {
  $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
	 include '../view/vehicle-update.php';
 exit;
}

$updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
if ($updateResult) {
 $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
	$_SESSION['message'] = $message;
	header('location: /phpmotors/vehicles/');
	exit;
} else {
	$message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
	 include '../view/vehicle-update.php';
	 exit;
	}
break;

case 'del':
  $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
  $invInfo = getInvItemInfo($invId);
  if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;

case 'deleteVehicle':
  $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
  $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
  $deleteResult = deleteVehicle($invId);
  if ($deleteResult) {
    $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;
  } else {
    $message = "<p class='notice'>Error: $invMake $invModel was not
  deleted.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;
  }
  break;

case 'classification':
  $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
  $vehicles = getVehiclesByClassification($classificationName);
  if(!count($vehicles)){
    $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
  } else {
    $vehicleDisplay = buildVehiclesDisplay($vehicles);
  }
  include '../view/classification.php';
  break;  

case 'carInfo':
  $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
  $invInfo = getInvItemInfo($vehicleId);
  $_SESSION['message'] = null;
  if ($invInfo) {
    $vehicle = vehicleDetailPage($invInfo);
      }
  else {
    $_SESSION['message'] = 'Sorry, no vehicle information could be found.';
  }
  include '../view/vehicle-detail.php';
  break;

default:
  $classificationList = buildClassificationList($classifications);
  
  include '../view/vehicle-management.php';
  break;
}
?>