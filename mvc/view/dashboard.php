<?php
session_start();
if (!isset($_SESSION["username"])) {
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
    <?php include '../view/header.php' ?>
    <header>
        <?php echo "Welcome <span>", $_SESSION["username"], "</span>! <br> Permission: ", $_SESSION["permission"] ?>
    </header>
    <div class="actionBar">
        <form action="../controller/books.controller.php" method="post" enctype="multipart/form-data">
            <fieldset class="hidden">
                <legend>
                    <h1>Add Book</h1>
                </legend>
            </fieldset>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" maxlength="40" pattern=".[a-zA-Z\W\s]{2,}" placeholder="Title">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" maxlength="40" pattern=".[a-zA-Z\W\s]{2,}" placeholder="Author">
            <label for="published">First Published Year</label><br>
            <input type="text" name="published" id="published" placeholder="YYYY" pattern="[0-9]{4}"><br>
            <label for="copies">Copies Sold</label><br>
            <input type="text" name="copies" id="copies" placeholder="Number Of Copies Sold" pattern="[0-9]{1,}"><br>
            <label for="bookRanking">Book Ranking</label><br>
            <input type="text" name="bookRanking" id="bookRanking" placeholder="Book Ranking" step="any" pattern="^([-+,0-9.]+)"><br>
            <label for="bookPlot">Book Plot</label><br>
            <textarea type="text" name="bookPlot" id="bookPlot" placeholder="Book Plot" pattern=".[a-zA-Z\W\s]{2,}" required></textarea><br>
            <span class="containerSelect">
                <span class="button-wrap">
                    <label class="new-button" for="cover"> Upload Cover </label>
                    <div id="file-upload-filename"></div>
                    <input id="cover" type="file" name="cover" accept="image/png, image/gif, image/jpeg" />
                </span>
            </span>
            <hr>
            <input id="newBook" type="submit" name="uploadBtn" value="Upload" />
            <hr>
            <!--<input id="cover" type="file" name="cover" accept="image/png, image/gif, image/jpeg"><br>-->
        </form>
    </div>
    <?php
    // Message for submitting books
    if (isset($_SESSION['message']) && $_SESSION['message']) {
        printf('<b class="successMsg">%s</b>', $_SESSION['message']);
        unset($_SESSION['message']);
    }
    ?>
    <section>
        <h1 class="bigTitle">Books</h1>
        <?php include 'books.php'; ?>
    </section>
    <?php include('../view/footer.php'); ?>
    <script src="../../public/js/functions.js"></script>
</body>

</html>