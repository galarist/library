<?php 
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <title>Dashboard</title>
</head>
<body>
    <?php include 'view/header.php'?>    
    <header><?php echo "Welcome <span>", $_SESSION["username"], "</span>!" ?></header>
    <section>
        <div class="actionBar">
            <button>Add New Book</button>
        </div>
        <article>
            books here
        </article>
    </section>
</body>
</html>