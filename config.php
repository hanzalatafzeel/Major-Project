<?php
$dbHost = "sql204.infinityfree.com";
$dbUsername = "if0_34401689";
$dbPassword = "ULEkmLzHpuk1";
$dbName = "canteen";

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}
?>