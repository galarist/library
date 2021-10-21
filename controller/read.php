<?php
ini_set('display_errors', "1");
// $_SERVER['SERVER_NAME'] gives the value of the server name as defined in host configuration
// $_SERVER['REQUEST_URI'] contains the URI of the current page
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url, 'users') == true) {
    require '../model/conn.php';
} else {
    require 'model/conn.php';
}

try {
    if (isset($_SESSION["username"])) {
        $currentUser = $_SESSION["username"];
        $database = "SELECT * FROM books INNER JOIN covers INNER JOIN users ON username = '$currentUser'";
    } else {
        $currentUser = '';
        $database = "SELECT * FROM books INNER JOIN covers";
    }
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare($database);
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
            $imagePath = "/library/public/img/covers/.jpg";
        }

        if (isset($_SESSION["username"]) && $row['permission'] == '1') {
            $actionButtons = '
            <legend>
                <div>
                    <button>Edit</button>
                    <a href="../controller/delete.php?id='.$row['bookID'].'">Delete</a>
                </div>
            </legend>
            ';
        } else {
            $actionButtons = '';
        }

        echo '
        <article>
            <div>
                <fieldset>
                    '.$actionButtons.'
                    <img src="'.$imagePath.'" alt="Cover">
                    <p>Author: '.$row['author'].'</p>
                </fieldset>
            </div>
        </article>
        ';
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
