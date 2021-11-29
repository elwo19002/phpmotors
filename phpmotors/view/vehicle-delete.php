<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /phpmotors/');
 exit;
}
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">

<head>
<title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php if (isset($message)) {echo $message;}?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
    <main>
    <h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1><br>
      <?php if (isset($message)) {echo $message;}?>
      <div class="addVehicle">
      <p>Confirm Vehicle Deletion. The delete is permanent.</p>
<br>

<form method="post" action="/phpmotors/vehicles/">
<fieldset>
	<label for="invMake">Vehicle Make</label>
	<input type="text" readonly name="invMake" id="invMake" <?php
if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

	<label for="invModel">Vehicle Model</label>
	<input type="text" readonly name="invModel" id="invModel" <?php
if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

	<label for="invDescription">Vehicle Description</label>
	<textarea name="invDescription" readonly id="invDescription"><?php
if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
?></textarea>

<input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

	<input type="hidden" name="action" value="deleteVehicle">
	<input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
echo $invInfo['invId'];} ?>">

</fieldset>
</form>
</div>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>