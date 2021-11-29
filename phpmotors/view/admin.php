<?php if (!$_SESSION['loggedin']) {
    header('Location: /phpmotors/accounts/?action=login');
}  
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }?><!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Motors</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/header.php';?>
<main>
<?php if (isset($message)) {echo $message;}?>
        <h1>Welcome <?php echo $_SESSION['clientData']['clientFirstname'];?>, you are logged in!</h1>
        
	    <div class="common-container">

				<h2>Account Management</h2>
                <p>Use the link below to update your account:</p>
				<a href="/phpmotors/accounts/index.php?action=updateClientView" >Update Account Information</a>
		</div>
        <p>Use the link below to manage your vehicle inventory:</p>
        <?php if (($_SESSION['clientData']['clientLevel']) > 1) {
            echo "<p class='indent'><a href='/phpmotors/vehicles/'>Vehicle Management</a></p>";
            } 
        ?>
        <p>Use the link below to manage your vehicle's images:</p>
        <?php if (($_SESSION['clientData']['clientLevel']) > 1) {
            echo "<p class='indent'><a href='/phpmotors/uploads/'>Image Management</a></p>";
            } 
        ?>
       
    </main>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/footer.php';?>
</body>
</html>