<?php
ini_set('display_errors', "1");

require 'model/conn.php';
try {
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $pdo->prepare("SELECT * FROM books");
    $query->execute();
    $results = $query->fetchAll();
    if ($query->rowCount() > 0) {
    } else {
        echo 'You Have no Books Stored';
    }
    foreach ($results as $row) {
        if ($row['cover'] == null) {
            $imagePath = "/library/public/img/covers/default.jpg";
        } else {
            $imagePath = "/library/public/img/covers/t9i-edit-book-covers-online.jpg";
        }
        
        echo '
        <article>
            <div>
                <fieldset>
                    <img src="'.$imagePath.'" alt="Cover">
                    <p>Published: '.$row['author'].'</p>
                    <p>Author: '.$row['author'].'</p>
                </fieldset>
            </div>
        </article>
        ';
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>