<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>


    <main>
    <?php if (isset($message)) {echo $message;}?>
    <h1><?php echo $classificationName; ?> vehicles</h1>
    <div class='vehicleDisplay'>
    <?php if(isset($vehicleDisplay)){
        echo $vehicleDisplay;
    } ?>
    </div>
      
      
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>