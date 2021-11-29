<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Image Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>


    <main>
    <?php if (isset($message)) {echo $message;}?>
      <h1>Welcome to Image Management! To manage your images, use the drop down below.</h1>
      <h2>Add New Vehicle Image</h2>

    <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
    <label for="invItem">Vehicle</label>
        <?php echo $prodSelect; ?>
        <fieldset>
            <label>Is this the main image for the vehicle?</label>
            <label for="priYes" class="pImage">Yes</label>
            <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
            <label for="priNo" class="pImage">No</label>
            <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </fieldset>
    <label>Upload Image:</label>
    <input type="file" name="file1">
    <input type="submit" class="regbtn" value="Upload">
    <input type="hidden" name="action" value="upload">
    </form>
    <h2>Existing Images</h2>
    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
    <?php
    if (isset($imageDisplay)) {
    echo $imageDisplay;
    } ?>
      
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>
<?php unset($_SESSION['message']); ?>