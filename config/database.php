<?php

//data base configuration
$host = 'localhost';
$dbname = 'contact_system';
$username = 'root';   
$password = '';    

// create the connection
try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo " databse connected successfully"; // need remove after testing
} catch(PDOException $e){
    die("connection failed: " .$e->getMessage());
}
?>