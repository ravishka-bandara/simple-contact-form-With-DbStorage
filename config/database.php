<?php

//data base configuration
$host = 'localhost';
$dbname = 'contact_system';
$username = 'root'   // default for xamp login
$password = '';    // default password empty 

// create the connection
try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE_EXPECTION);
    echo " databse connected successfully"; // need remove after testing
} catch(PDOException $e){
    die("connection failed: " .$e->getMessage());
}
?>