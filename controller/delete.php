<?php
require '../model/conn.php'; // Connection script
$id = $_GET['id']; // get id through query string
session_start();
// Only admin can edit
if (!isset($_SESSION["username"]) && $_SESSION['permission'] !== '1') {
    header('Location: ../');
} else {
    try {
        $conn = new PDO($dsn, $user, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // sql to delete a record
        $sql = "DELETE FROM books WHERE bookID=$id;";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Record deleted successfully";
        header("Location: ../users/dashboard.php");
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>