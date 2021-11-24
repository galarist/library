
<?php
ini_set('display_errors', "1");
// $_SERVER['SERVER_NAME'] gives the value of the server name as defined in host configuration
// $_SERVER['REQUEST_URI'] contains the URI of the current page
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// Checkks if url contains /view/
if (strpos($url, 'view') == true) {
    include '../controller/books.controller.php';
} else if (strpos($url, 'controller') == true) {
    //echo "string";
} else {
    //include 'mvc/controller/books.controller.php';
}

try {
    foreach ($books as $row) {
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
                ';
            include '../view/header.php';
            echo "<header>Welcome <span>", $_SESSION["username"], "</span>! <br> Permission: ", $_SESSION["permission"] . "</header>";
            $_SESSION['coverName'] = $row['cover'];
            echo '
            <div class="actionBar">
                <form action="" method="POST" enctype="multipart/form-data">
                    <fieldset class="hidden">
                        <legend>
                            <h1>Edit Book</h1>
                        </legend>
                    </fieldset>
                    <input type="hidden" name="id" value="' . $row['bookID'] . '">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title" maxlength="40" pattern=".[a-zA-Z\W\s]{2,}" value="' . $row['title'] . '">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" placeholder="Author" maxlength="40" pattern=".[a-zA-Z\W\s]{2,}" value="' . $row['author'] . '">
                    <label for="published">First Published Year</label><br>
                    <input type="text" name="published" id="published" placeholder="YYYY" pattern="[0-9]{4}" value="' . $row['published'] . '"><br>
                    <label for="copies">Copies</label><br>
                    <input type="text" name="copies" id="copies" placeholder="Number Of Copies"  pattern="[0-9]{1,}" value="' . $row['copies'] . '"><br>
                    <label for="bookRanking">Book Ranking</label><br>
                    <input type="text" name="bookRanking" id="bookRanking" placeholder="Book Ranking" step="any" pattern="^([-+,0-9.]+)" value="' . filter_var($row['ranking'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) . '"><br>
                    <label for="bookPlot">Book Plot</label><br>
                    <textarea type="text" name="bookPlot" id="bookPlot" placeholder="Book Plot" pattern=".[a-zA-Z\W\s]{2,}">' . $row['bookPlot'] . '</textarea><br>
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
            </div>';

            echo '
            <script src="../../public/js/functions.js"></script>
            </body>
            
            </html>
            ';
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>