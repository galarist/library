<?php
ini_set('display_errors', "1");
// $_SERVER['SERVER_NAME'] gives the value of the server name as defined in host configuration
// $_SERVER['REQUEST_URI'] contains the URI of the current page
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// Checkks if url contains /users/
if (strpos($url, 'users') == true) {
    require '../model/conn.php';
} else {
    require 'model/conn.php';
}

try {
    if (isset($_SESSION["username"])) {
        $currentUser = $_SESSION["username"];
        $database = "SELECT * FROM books 
                    INNER JOIN covers ON books.bookID=covers.bookID 
                    LEFT JOIN users ON username = '$currentUser'";
    } else {
        $currentUser = '';
        $database = "SELECT * FROM books 
        INNER JOIN covers ON books.bookID=covers.bookID";
    }
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare($database);
    $query->execute();
    $results = $query->fetchAll();
    if ($query->rowCount() > 0) {
    } else {
        echo '<h2>You Have No Books Stored</h2>';
    }
    foreach ($results as $row) {
        // Check if row is empty (use default cover) and check url under users
        if ($row['cover'] == null && strpos($url, 'users') == true) {
            $imagePath = "/library/public/img/covers/default.jpg";
        } elseif ($row['cover'] !== null && strpos($url, 'users') == false) {
            $imagePath = "public/img/covers/";
        } else {
            $imagePath = "../public/img/covers/";
        } 
        //Ony admin has permission to Edit/Delete a book under the users folder
        if (isset($_SESSION["username"]) && $row['permission'] == '1' && strpos($url, 'users') == true) {
            $actionButtons = '
            <legend>
                <div>
                    <a class="actionBtn" href="../controller/update.php?id='.$row['bookID'].'">Edit</a>
                    <a class="actionBtn" href="../controller/delete.php?id='.$row['bookID'].'">Delete</a>
                </div>
            </legend>
            ';
        } else {
            $actionButtons = '';
        }

        echo '
        <article>
            <div>
                <fieldset id="details">
                    '.$actionButtons.'
                    <img src="'.$imagePath.$row['cover'].'" alt="Cover">
                    <p id="author">Book Title:<br> '.$row['title'].'</p>
                </fieldset>
            </div>
        </article>
        ';
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
