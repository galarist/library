<?php
require '../model/users.model.php';
// The purpose of this block will create a user
if (isset($_POST['submit'])) {
    try {
        $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        checkUser($conn, $host, $dbname, $user, $password);
        $message = $_SESSION["message"];
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
        $message = $error;
    }
}
// this will login the user
try {
    if (isset($_POST['login'])) {
        userLogin($conn, $host, $dbname, $user, $password);
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
// This block of code will logout the user after clicking logout
if (isset($_GET['logout'])) {
    //Session ends  
    session_start();
    session_destroy();
    header("location:/library"); 
}