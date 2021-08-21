<?php 
session_start();
if(!isset($_SESSION["username"])) {
    header("Location:/library");
} elseif ($_SESSION['permission'] == 0) {
    header("Location:/library");
}
?>
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

        <div class="actionBar">
            <button>Add New Book</button>
        </div>
    </header>
    <section>
        <?php include '../controller/read.php'; ?>
    </section>
</body>

</html>