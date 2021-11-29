<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Motors | Add Vehicle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
    <main>
    <?php if (isset($message)) {echo $message;}?>
      <h1>Add Vehicle</h1><br>
      
      <div class="addVehicle">
      <h3>*Note all Fields are Required</h3><br>

    <form method="post" action="/phpmotors/vehicles/index.php?action=add-vehicle">
    <h3>Vehicle Classification</h3>
    <?php echo $classificationList; ?><br>
    <br><label for="make">Make</label><br>
    <input type="text" id="make" name="invMake" required pattern="[a-zA-Z]+" <?php if(isset($invMake)){echo "value='$invMake'";}  ?>><br><br>
    <label for="model">Model</label><br>
    <input type="text" id="model" name="invModel" required pattern="[A-Za-z0-9]+" <?php if(isset($invModel)){echo "value='$invModel'";}  ?>><br><br>
    <label for="description">Description</label><br>
    <textarea id="description" name="invDescription" rows="4" cols="20" required ></textarea>
    <br><br><label for="imagePath">Image Path</label><br>
    <input value="/phpmotors/images/no-image.png" type="text" id="imagePath" name="invImage" required <?php if(isset($invImage)){echo "value='$invImage'";}  ?>><br><br>
    <label for="thumbPath">Thumbnail Path</label><br>
    <input value="/phpmotors/images/no-image.png" type="text" id="thumbPath" name="invThumbnail" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>><br><br>
    <label for="price">Price</label><br>
    <input type="text" id="price" name="invPrice" required pattern="[0-9]+" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>><br><br>
    <label for="invStock">Stock</label><br>
    <input type="text" name="invStock" id="invStock" required pattern="[0-9]+" <?php if(isset($invStock)){echo "value='$invStock'";}  ?>><br><br>
    <label for="invColor">Color</label><br>
    <input type="text" name="invColor" id="invColor" required pattern="[A-Za-z]+" <?php if(isset($invColor)){echo "value='$invColor'";}  ?>><br><br>
    <input class="button" type="submit" name="submit" id="addVehicle" value="Add Vehicle">
    <input type="hidden" name="action" value="addVehicle">
</form>
</div>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>