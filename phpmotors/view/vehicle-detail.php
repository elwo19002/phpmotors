<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
<head>
<title>Vehicle Details | PHP Motors, Inc.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>


    <main>
    <?php if (isset($message)) {echo $message;}?>
    <?php echo $vehicle; ?><br><br><br><br><br><br>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>