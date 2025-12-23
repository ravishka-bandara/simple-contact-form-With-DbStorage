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

    
}