<?php
    // Adding new books
function create_books($dsn, $title, $author, $bookPlot, $published, $ranking, $copies, $newFileName) {
    global $conn;
    // Check if book exists
    $sql = "SELECT * FROM books WHERE title = :title";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':title', $title, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (trim($published) == '' || trim($copies) == '') {
        $message = "You did not fill out the fields.";
    } elseif ($row['title'] == $title) {
        $message = "Book already exists";
    } else {
        $stmt = $dsn->prepare("INSERT INTO books (title, author, bookPlot, published, ranking, copies) 
                                VALUES (:title, :author, :bookPlot, :published, :ranking, :copies);");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':bookPlot', $bookPlot);
        $stmt->bindParam(':published', $published);
        $stmt->bindParam(':ranking', $ranking);
        $stmt->bindParam(':copies', $copies);
        if ($stmt->execute()) {
            // Get and Insert the last bookID into the covers table
            $message = "New Book Added.";
            $last_id = $dsn->lastInsertId();
            $message = "New record created successfully. Last inserted ID is: " . $last_id;
            $stmt = $dsn->prepare("INSERT INTO covers (bookID, cover) 
                                    VALUES ($last_id, '$newFileName');");
            $stmt->execute();
            //redirect to another page
            header("Location: ../view/dashboard.php");
        } else {
            $message = "An error occurred!";
        }
    }
}
// Reading the books from the databse
function read_books() {
    global $conn;
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

    if (isset($_GET['update'])) {
        $id = $_GET['id'];
        $database = "SELECT * FROM books 
        INNER JOIN covers 
        ON books.bookID=covers.bookID
        WHERE books.bookID = $id";
    }

    $query = $conn->prepare($database);
    $query->execute();
    $results = $query->fetchAll();
    
    if ($query->rowCount() > 0) {
    } else {
        echo '<h2>You Have No Books Stored</h2>';
    }
    return $results;
}
$id = '';
// will update selected book
function update_books($newFileName, $bookIDSession, $title, $author, $bookPlot, $published, $ranking, $copies) {
    global $conn;
    $bookIDSession = $_SESSION['bookID'];
    $currentUser = $_SESSION["username"];
    //echo $bookIDSession;
    // Update data
    $query = "UPDATE books, covers 
            SET title = '$title',
                author = '$author',
                bookPlot = '$bookPlot',
                published = '$published',
                ranking = '$ranking',
                copies = '$copies',
                cover = '$newFileName',
                editedBy = '$currentUser'
            WHERE books.bookID = covers.bookID 
            AND books.bookID = '$bookIDSession'";
    $conn->exec($query);

}
// Will delete selected book
function delete_books($id) {
    global $conn;
    if (isset($_GET['delete']) && $_SESSION['permission'] == '1') {
        $id = $_GET['id']; // get id through query string
    }
    // sql to delete a record
    $sql = "DELETE FROM books WHERE bookID=$id;";
    // use exec() because no results are returned
    $conn->exec($sql);
}

?>