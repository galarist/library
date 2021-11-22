<?php
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

?>