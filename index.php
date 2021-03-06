<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <title>ICTDBS504 - AT2</title>
</head>

<body>
    <?php include('mvc/view/header.php'); ?>
    <header>
        <?php
        if (isset($_SESSION["username"])) {
            echo "Welcome <span>", $_SESSION["username"], "</span>! <br> Permission: ", $_SESSION["permission"];
        }
        ?>
    </header>
    <section>
        <?php include 'mvc/view/books.php'; ?>
    </section>
    <?php include('mvc/view/footer.php'); ?>
</body>

</html>