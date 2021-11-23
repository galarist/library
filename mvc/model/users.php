<?php
session_start();
require '../model/conn.php';

function createUser($dsn, $fName, $lName, $user, $email, $pwd, $permission) {
    // Create user
    $stmt = $dsn->prepare("INSERT INTO users (permission, firstName, lastName, username, email, password) 
                    VALUES (:permission, :firstName, :lastName, :username, :email, :password)");
    // Binds a parameter to the specified variable name
    $stmt->bindParam(':firstName', $fName);
    $stmt->bindParam(':lastName', $lName);
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $pwd);
    $stmt->bindParam(':permission', $permission);
    $stmt->execute();
}

function checkUser ($conn, $host, $dbname, $user, $password)
{
    require '../model/conn.php';
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Input field call + sanitize
    $fName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $lName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pwd = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $permission = filter_var($_POST['permission'], FILTER_SANITIZE_NUMBER_INT);
    // Increase the default cost for BCRYPT to 12
    // Also switched to 60 characters (BCRYPT)
    $pwd = password_hash($pwd, PASSWORD_BCRYPT, array("cost" => 12));

    // Check if username exists
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':username', $user);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (trim($permission) == '' || !isset($fName) || trim($lName) == '' || trim($user) == '' || trim($email) == '' || trim($pwd) == '') {
        $message = "You did not fill out the fields.";
    } elseif ($row['num'] > 0) {
        $message = "Username already exists";
    } else {
        createUser($dsn, $fName, $lName, $user, $email, $pwd, $permission);
        if ($stmt->execute()) {
            $message = "New account created.";
        } else {
            $message = "An error occurred!";
        }
    }
    $_SESSION["message"] = $message;
    
}
?>