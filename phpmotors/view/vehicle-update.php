<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
    <main>
    <?php if (isset($message)) {echo $message;}?>
    <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
	echo "Modify$invMake $invModel"; }?></h1><br>
      <div class="addVehicle">
      <h3>*Note all Fields are Required</h3><br>

    <form method="post" action="/phpmotors/vehicles/index.php?action=add-vehicle">
    <h3>Vehicle Classification</h3>
    <?php echo $classificationList; ?><br>
    <br><label for="make">Make</label><br>
    <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br><br>
    <label for="model">Model</label><br>
    <input type="text" id="model" name="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";}  ?>><br><br>
    <label for="description">Description</label><br>
    <textarea name="invDescription" id="invDescription" required>
<?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
    <br><br><label>Image Path</label><br>        
    <input required type="text" name="invImage" id="invImage" <?php if(isset($invImage)){echo "value='$invImage'";}  elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }  ?> ><br>
    <label>Thumbnail Path</label><br>
    <input required type="text" name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?> ><br><br><br>
    <label for="price">Price</label><br>
    <input type="text" id="price" name="invPrice" required pattern="[0-9]+" <?php if(isset($invPrice)){echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";}  ?>><br><br>
    <label for="invStock">Stock</label><br>
    <input type="text" name="invStock" id="invStock" required pattern="[0-9]+" <?php if(isset($invStock)){echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";}  ?>><br><br>
    <label for="invColor">Color</label><br>
    <input type="text" name="invColor" id="invColor" required pattern="[A-Za-z]+" <?php if(isset($invColor)){echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";}  ?>><br><br>
    <input type="submit" name="submit" value="Update Vehicle">
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="
<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
elseif(isset($invId)){ echo $invId; } ?>">
</form>
</div>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>