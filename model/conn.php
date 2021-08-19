<?php
    $dsn = 'mysql:dbname=library;host=127.0.0.1';
    $user = 'admin';
    $password = 'admin';

    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>