<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
  header('location: /phpmotors/');
  exit;
 }
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Motors | Vehicle Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
    <main>
      <h1>Vehicle Management</h1>
      <div class=addLinks>
      <a href="/phpmotors/vehicles/index.php?action=addClass" >Add Classification</a><br>
      <a href="/phpmotors/vehicles/index.php?action=addVehicle" >Add Vehicle</a>
      <?php
      if (isset($message)) {echo $message;}
      if (isset($classificationList)) { 
      echo '<h2>Vehicles By Classification</h2>'; 
      echo '<p>Choose a classification to see those vehicles</p>'; 
      echo $classificationList; 
      }
      ?>
      <br>
      <noscript>
      <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
      </noscript>
      <table id="inventoryDisplay"></table>
      <br><br>
      
    </div>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
<script src="../js/inventory.js"></script>  
</body>
</html><?php unset($_SESSION['message']); ?>