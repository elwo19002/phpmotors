<?php
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Motors | Create Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
<?php if (isset($message)) {echo $message;}?>

<form method="post" action="/phpmotors/accounts/index.php">
    <br>
    <label for="clientFirstname"><b>First Name</b></label>
    <input name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> type="text" required>
    <br>
    <br>
    <label for="clientLastname"><b>Last Name</b></label>
    <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
    <br><br>
    <label for="clientEmail"><b>Email</b></label>
    <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
    <br><br>
    <label for="clientPassword"><b>Password</b></label>
    <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
    <br><div><br>
    <button type="submit" class="signupbtn" >Sign Up</button>
    <input type="hidden" name="action" value="register">
    </div>
    </form>
      

<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>

</body>
</html>