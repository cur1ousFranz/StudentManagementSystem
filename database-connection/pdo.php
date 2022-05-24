<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db = "student_management_system";

    try{
        $GLOBALS['pdo'] = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo $e->getError();
    }
?>