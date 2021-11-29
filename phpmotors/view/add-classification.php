<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Motors | Add Classification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
  <div>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>

    <main>
    <?php if (isset($message)) {echo $message;}?>
  <div class="createContent">
    <h1>Add Classification</h1>
    <form method="post" action="/phpmotors/vehicles/index.php">
    <br>
    <label for="classificationName"><b>Classification Name</b></label>
    <input name="classificationName" id="classificationName" type="text" required pattern="[A-Za-z]+" <?php if(isset($classificationName)){echo "value='$classificationName'";}  ?>>
    <div>
    <br>
    <input class="button" type="submit" name="submit" id="addClass" value="Create Classification">
    <input type="hidden" name="action" value="addClass">
    </div>
    </form>
  </div>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
  </div>
</body>
</html>