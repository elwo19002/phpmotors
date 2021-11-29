<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Motors | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
<?php if (isset($message)) {echo $message;}?>
<form action="/phpmotors/accounts/" method="post">
  <div class="container">
  <br><br>
    <label for="clientEmail"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" id="clientEmail" name='clientEmail' <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
    <br>
    <br>
    <label for ="clientPassword"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="clientPassword" name='clientPassword' required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
    <br><br>
    <button type="submit">Login</button>
    <input type="hidden" name="action" value="Login">
    <a href = "/phpmotors/accounts/index.php?action=create" class = "create" > Create Account</a>
  </div>
</form>

<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>

</body>
</html>