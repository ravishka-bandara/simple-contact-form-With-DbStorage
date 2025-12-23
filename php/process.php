<?php
//include db connection
require_once 'config/database.php';

//start the seccion (for store success error message)
session_start();

//check form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //get form data sanitize means cleaning and securting like wash vege befo coock
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    //basic validation
    $errors = [];

    if(empty($name)){
        $errors[] ="Name is required you dumb";
    }

    if(empty($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Valid email is required";
    }

    if(empty($message)){
        $errors[] = "Message is required";
    }

    //if no errors , insert in to database
    if(empty($errors)){
        try{
            //made sql statement
            $sql = "INSERT INTO contacts (name, email, phone, message)
            VALUES (:name, :email, :phone, :message)";

            $stmt = $pdo->prepare($sql);

            // binding parameeters
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':phone',$phone);
            $stmt->bindParam(':message',$message);

            
        }
    }
}