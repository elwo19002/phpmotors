<?php
if ($_SESSION['clientData']['clientLevel'] < 1) {
  header('location: /phpmotors/');
  exit;
 }
 if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Motors | Account Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
    <main>
	<?php if (isset($message)) {echo $message;}?>
      <h1>Account Management</h1>
	  <form id="account" method="post" action="/phpmotors/accounts/index.php">
				<fieldset>
					<legend>Account Information</legend>
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
					<button type="submit" class="updateClient" >Update User Information</button>
					<input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">

					<input type="hidden" name="action" value="updateAccount">
				</fieldset>
			</form>

			<form id="passwordForm" method="post" action="/phpmotors/accounts/index.php">
				<fieldset>
					<legend>Password</legend>
					<?php
						if (isset($messagePassword)) {
							echo $messagePassword;
						}
					?>
					<label for="clientPassword"><b>Password</b></label>
					<input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
					<button type="submit" class="updatePassword" >Update Password</button>
					<input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">

					<input type="hidden" name="action" value="updatePassword">
				</fieldset>
			</form>
    </main> 
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
<script src="../js/inventory.js"></script>  
</body>
</html><?php unset($_SESSION['message']); ?>