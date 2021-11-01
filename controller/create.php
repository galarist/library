<?php
require '../model/conn.php'; // Connection script
session_start();

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
            $uploadFileDir = '../public/img/covers/';
            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $message ='File is successfully uploaded.';
                try {
                    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // Input field call
                    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                    $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
                    $published = filter_var($_POST['published'], FILTER_SANITIZE_NUMBER_INT);
                    $copies = filter_var($_POST['copies'], FILTER_SANITIZE_NUMBER_INT);
                    $cover = $newFileName;

                    // Check if book exists
                    $sql = "SELECT * FROM books WHERE title = :title";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindValue(':title', $title, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if(trim($published) == '' || trim($copies) == '') {
                        $message = "You did not fill out the fields.";
                        } elseif ($row['title'] == $title) {
                            $message = "Book already exists";
                        } else {
                            $stmt = $dsn->prepare("INSERT INTO books (title, author, published, copies) 
                            VALUES (:title, :author, :published, :copies);");
                            $stmt->bindParam(':title', $title);
                            $stmt->bindParam(':author', $author);
                            $stmt->bindParam(':published', $published);
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
                                //header("refresh:2;url=/library/users/signin.php");
                            } else {
                                $message = "An error occurred!";
                            }
                        }
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
header("Location: ../users/dashboard.php");
?>