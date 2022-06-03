<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db = "sms_db";

    try{
        $GLOBALS['pdo'] = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo "Cannot connect";
    }
?>