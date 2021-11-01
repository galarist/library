<?php 
session_start();
if(!isset($_SESSION["username"])) {
    header("Location:/library");
} elseif ($_SESSION['permission'] == 0) {
    header("Location:/library");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/library/public/css/style.css">
    <link rel="shortcut icon" href="/library/public/img/favicon.ico" type="image/x-icon">
    <title>Dashboard</title>
</head>

<body>
    <?php include '../view/header.php'?>
    <header>
        <?php echo "Welcome <span>", $_SESSION["username"], "</span>! <br> Permission: ", $_SESSION["permission"] ?>
    </header>
        <div class="actionBar">
            <form action="../controller/create.php" method="post" enctype="multipart/form-data">
                <fieldset class="hidden">
                    <legend>
                        <h1>Add Book</h1>
                    </legend>
                </fieldset>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" placeholder="Author">
                <label for="published">First Published Year</label><br>
                <input type="text" name="published" id="published" placeholder="YYYY"><br>
                <label for="copies">Copies</label><br>
                <input type="text" name="copies" id="copies" placeholder="Number Of Copies"><br>
                <label for="bookPlot">Book Plot</label><br>
                <textarea type="text" name="bookPlot" id="bookPlot" placeholder="Book Plot"></textarea><br>
                <span class="containerSelect">
                    <span class="button-wrap">
                        <label class="new-button" for="cover"> Upload Cover </label>
                        <div id="file-upload-filename"></div>
                        <input id="cover" type="file" name="cover" accept="image/png, image/gif, image/jpeg"/>
                    </span>
                </span>
                <hr>
                <input id="newBook" type="submit" name="uploadBtn" value="Upload" />
                <hr>
                <!--<input id="cover" type="file" name="cover" accept="image/png, image/gif, image/jpeg"><br>-->
            </form>
        </div>
        <?php
            if (isset($_SESSION['message']) && $_SESSION['message']) {
                printf('<b class="successMsg">%s</b>', $_SESSION['message']);
                unset($_SESSION['message']);
            }
        ?>
    <section>
        <h1 class="bigTitle">Books</h1>
        <?php include '../controller/read.php'; ?>
    </section>
    <?php include('../view/footer.php'); ?>
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
</body>

</html>