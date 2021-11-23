<?php
require '../model/users.model.php';
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
