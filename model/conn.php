<?php
$host = 'localhost';
$user = 'admin'; //database username
$password = 'admin'; //database password
$dbname = 'library'; //database name
$dsn = '';

try {
    $dsn = 'mysql:host='.$host. ';dbname='.$dbname;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'connection failed: '.$e->getMessage();
}
