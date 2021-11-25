<?php
ini_set('display_errors', "1");
// $_SERVER['SERVER_NAME'] gives the value of the server name as defined in host configuration
// $_SERVER['REQUEST_URI'] contains the URI of the current page
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// Checkks if url contains /view/
if (strpos($url, 'view') == true) {
    require('../model/conn.php');
    require('../model/books.model.php');
} else if (strpos($url, 'controller') == true) {
    require('../model/conn.php');
    require('../model/books.model.php');
    session_start();
} else {
    require('mvc/model/conn.php');
    require('mvc/model/books.model.php');
}
// Will trigger upload for book
if (isset($_POST["uploadBtn"])) {
    // Only admin can edit
    if (!isset($_SESSION["username"]) && $_SESSION['permission'] !== '1') {
        header('Location: ../../');
    } else {
        $message = '';
        if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
            if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
                // get details of the uploaded file
                $fileTmpPath = $_FILES['cover']['tmp_name'];
                $fileName = $_FILES['cover']['name'];
                $fileSize = $_FILES['cover']['size'];
                $fileType = $_FILES['cover']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // sanitize file-name
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                // check if file has one of the following extensions
                $allowedfileExtensions = array('jpg', 'gif', 'png');

                if (in_array($fileExtension, $allowedfileExtensions)) {
                    // directory in which the uploaded file will be moved
                    $uploadFileDir = '../../public/img/covers/';
                    $dest_path = $uploadFileDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $message = 'File is successfully uploaded.';
                        try {
                            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            // Input field call
                            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                            $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
                            $published = filter_var($_POST['published'], FILTER_SANITIZE_NUMBER_INT);
                            $copies = filter_var($_POST['copies'], FILTER_SANITIZE_NUMBER_INT);
                            $ranking = filter_var($_POST['bookRanking'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                            $bookPlot = filter_var($_POST['bookPlot'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                            $cover = $newFileName;

                            create_books($dsn, $title, $author, $bookPlot, $published, $ranking, $copies, $newFileName);
                        } catch (PDOException $e) {
                            $error = "Error: " . $e->getMessage();
                            $message = $error;
                        }
                    } else {
                        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                    }
                } else {
                    $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                }
            } else {
                $message = 'There is some error in the file upload. Please check the following error.<br>';
                $message .= 'Error:' . $_FILES['cover']['error'];
            }
        }
        $_SESSION['message'] = $message;
    }
}

$books = read_books();

if (isset($_GET['update'])) {
    // Only admin can edit
    if (isset($_SESSION["username"]) && $_SESSION['permission'] == '1') {
        //The parameter you need is present
        include '../view/editBook.php';
        $id = $_REQUEST['id']; // get id through query string
        $_SESSION['bookID'] = $id;
        $bookIDSession = $_SESSION['bookID'];
        $id = $bookIDSession;
    } else {
        header('Location: ../../');
    }
}

try {
    foreach ($books as $key) {}
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
            $uploadFileDir = '../../public/img/covers/';
            $dest_path = $uploadFileDir . $newFileName;
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = "Image uploaded successfully";
            } else {
                $message = "Failed to upload image";
            }
            if ($_FILES["uploadfile"]["error"] == 4) {
                //means there is no file uploaded
                $newFileName = $key['cover'];
            }
            // Input field call
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
            $published = filter_var($_POST['published'], FILTER_SANITIZE_NUMBER_INT);
            $copies = filter_var($_POST['copies'], FILTER_SANITIZE_NUMBER_INT);
            $ranking = filter_var($_POST['bookRanking'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $bookPlot = filter_var($_POST['bookPlot'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            update_books($newFileName, $bookIDSession, $title, $author, $bookPlot, $published, $ranking, $copies);
            header("Refresh:0");
            $edited = 'Edited by: '.$_SESSION['username'] ." | ". 'Edited bookID: ' . $_SESSION['bookID'];
            $file = fopen("../../resources/tracker/trackedit.md", "a");
            fwrite($file, $edited . PHP_EOL);
            fclose($file);       
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            $message = $error;
        }
        $_SESSION['message'] = $message;
    }
} catch (PDOException $error) {
    echo $error . "<br>" . $error->getMessage();
}

if (isset($_GET['delete'])) {
    // Only admin can edit
    if (!isset($_SESSION["username"]) && $_SESSION['permission'] !== '1') {
        header('Location: ../../');
    } else {
        try { // Only admin can edit
            if (isset($_SESSION["username"]) && $_SESSION['permission'] == '1') {
                delete_books($id);
                echo "Record deleted successfully";
                header("Location: ../view/dashboard.php");
            } else {
                header('Location: ../../');
            }
        } catch (PDOException $e) {
            //echo $sql . "<br>" . $e->getMessage();
        }
    }
}
?>