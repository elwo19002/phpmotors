<?php
 function phpmotorsConnect(){

$server = 'localhost';
$dbname = 'phpmotors';
$username = 'iclient';
$password = 'o2mE2uT0RMD_[KXh';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
   } catch(PDOException $e) {
    header('Location: /phpmotors/view/500.php');
    exit;
   }
}

phpmotorsConnect();