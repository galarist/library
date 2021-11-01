<?php
require '../model/conn.php'; // Connection script
$id = $_REQUEST['id']; // get id through query string
session_start();
$_SESSION['bookID'] = $id;
$bookIDSession = $_SESSION['bookID'];
$id = $bookIDSession;

try {
    $database = "SELECT * FROM books 
        INNER JOIN covers 
        ON books.bookID=covers.bookID
        WHERE books.bookID = '$bookIDSession'";
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare($database);
    $query->execute();
    $results = $query->fetchAll();
    foreach ($results as $key) {
        echo '
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/library/public/css/style.css">
        <link rel="shortcut icon" href="/library/public/img/favicon.ico" type="image/x-icon">
        <title>Sign In</title>
    </head>
    
    <body>
        '; include '../view/header.php';
        echo "<header>Welcome <span>", $_SESSION["username"], "</span>! <br> Permission: ", $_SESSION["permission"]."</header>";
        echo '
        <div class="actionBar">
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset class="hidden">
                    <legend>
                        <h1>Edit Book</h1>
                    </legend>
                </fieldset>
                <input type="hidden" name="id" value="'.$key['bookID'].'">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title"  value="'.$key['title'].'">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" placeholder="Author" value="'.$key['author'].'">
                <label for="published">First Published Year</label><br>
                <input type="text" name="published" id="published" placeholder="YYYY" value="'.$key['published'].'"><br>
                <label for="copies">Copies</label><br>
                <input type="text" name="copies" id="copies" placeholder="Number Of Copies" value="'.$key['copies'].'"><br>
                <label for="bookRanking">Book Ranking</label><br>
                <input type="text" name="bookRanking" id="bookRanking" placeholder="Book Ranking" value="'.filter_var($key['ranking'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION).'"><br>
                <label for="bookPlot">Book Plot</label><br>
                <textarea type="text" name="bookPlot" id="bookPlot" placeholder="Book Plot">'.$key['bookPlot'].'</textarea><br>
                <span class="containerSelect">
                    <span class="button-wrap">
                        <label class="new-button" for="cover">Change Cover</label>
                        <div id="file-upload-filename"></div>
                        <input id="cover" type="file" name="uploadfile" accept="image/png, image/gif, image/jpeg"/>
                    </span>
                </span>
                <hr>
                <button id="newBook" type="submit" name="upload">Update</button>
                <hr>
            </form>
        </div>
    </body>
    
    </html>
        ';
    }    
      
    $message = "";

    // If upload button is clicked ...
    if (isset($_POST['upload'])) {
        try {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['uploadfile']['tmp_name'];
            $fileName = $_FILES['uploadfile']['name'];
            $fileSize = $_FILES['uploadfile']['size'];
            $fileType = $_FILES['uploadfile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            // sanitize file-name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../public/img/covers/';
            $dest_path = $uploadFileDir . $newFileName;
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = "Image uploaded successfully";
            } else{
                $message = "Failed to upload image";
            }
            if($_FILES["uploadfile"]["error"] == 4) {
                //means there is no file uploaded
                $newFileName = $key['cover'];
            }
            // Make connection
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Input field call
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
            $published = filter_var($_POST['published'], FILTER_SANITIZE_NUMBER_INT);
            $copies = filter_var($_POST['copies'], FILTER_SANITIZE_NUMBER_INT);
            $ranking = filter_var($_POST['bookRanking'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $bookPlot = filter_var($_POST['bookPlot'], FILTER_SANITIZE_URL);
            // Update data
            $stmt = $dsn->prepare("UPDATE books, covers 
            SET title = :title,
                author = :author,
                bookPlot = :bookPlot,
                published = :published,
                ranking = :ranking,
                copies = :copies,
                cover = '$newFileName'
            WHERE books.bookID = covers.bookID 
            AND books.bookID = '$bookIDSession'");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':bookPlot', $bookPlot);
            $stmt->bindParam(':published', $published);
            $stmt->bindParam(':ranking', $ranking);
            $stmt->bindParam(':copies', $copies);
            
            // execute the query
            $stmt->execute();
        
            header("Refresh:0");
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            $message = $error;
        }
    }
    $_SESSION['message'] = $message;
} catch (PDOException $error) {
    echo $error . "<br>" . $error->getMessage();
}
// Only admin can edit
if (!isset($_SESSION["username"]) && $_SESSION['permission'] !== '1') {
    header('Location: ../');
}
?>
<script>
    var input = document.getElementById('cover');
    var infoArea = document.getElementById('file-upload-filename');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        // the change event gives us the input it occurred in 
        var input = event.srcElement;

        if (input.files.length == 0) {
            // if fileName is empty
            infoArea.textContent = '';
        } else {
            // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
            var fileName = input.files[0].name;

            // use fileName however fits your app best, i.e. add it into a div
            infoArea.textContent = fileName;
        }
    }
</script>