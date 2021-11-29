<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Motors | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>

    <main>
    <?php if (isset($message)) {echo $message;}?>
    <h1>Welcome to PHP Motors!</h1>
    <p class ="p2">DMC Delorean<p>
    <p class="p3">3 Cup holders<p>
    <p class="p3">Superman doors<p>
    <p class="p3">Fuzzy dice!<p>
    <br>
    <img class="delorean" alt=delorean src="/phpmotors/uploads/images/delorean.jpg">
    <input class="owntoday" type="submit" name="submit" value="Own Today">  
    <p class ="p2">DMC Delorean Reviews<p>
    <ul class="reviews">
        <li>"So fast its almost like traveling in time." (4/5)</li>
        <li>"Coolest ride on the road" (4/5)</li>
        <li>"I'm feeling Marty McFLy!" (5/5)</li>
        <li>"The most futuristic ride of our day" (4.5/5)</li>
        <li>"80's livin and I love it!" (5/5)</li>
    </ul> 
    <p class ="p2">Delorean Upgrades<p>
    <div class="grid-container">
        <div class="flux">
            <img alt=fluxCapacitor src="/phpmotors/images/upgrades/flux-cap.png">
            <br>
            <a href="url">Flux Capacitor</a>
        </div>
        <div class="flame">
            <img alt=flame src="/phpmotors/images/upgrades/flame.jpg">
            <br>
            <a href="url">Flame Decals</a>
        </div>
        <div class="bumpersticker">
            <img alt=bumpersticker src="/phpmotors/images/upgrades/bumper_sticker.jpg">
            <br>
            <a href="url">Bumper Stickers</a>
        </div>  
        <div class="hubcap">
            <img alt=hubcap src="/phpmotors/images/upgrades/hub-cap.jpg">
            <br>
            <a href="url">Hub Caps</a>
        </div>
    </div>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>