<?php
//database connection
require_once 'config/database.php';

//start the session :if needed
 session_start();

 //fetch all contacts from database
 $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
 $stmt = $pdo->query($sql);
 $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
