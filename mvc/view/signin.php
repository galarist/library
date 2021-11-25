<?php
require '../controller/users.controller.php';
?>
<html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/library/public/css/style.css">
    <link rel="shortcut icon" href="/library/public/img/favicon.ico" type="image/x-icon">
    <title>Sign In</title>
</head>

<body>
    <?php include '../view/header.php' ?>
    <div class="container">
        <?php
        if (isset($message)) {
            echo '<label class="textDanger">' . $message . '</label>';
        }
        // redirecting logged in user
        if (isset($_SESSION["username"])) {
            header("location:/library");
        }
        ?>
        <form method="post">
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" name="username" class="form-control" />
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" class="form-control" />
                <input type="submit" name="login" class="button" value="Login" />
            </div>
        </form>
    </div>
</body>

</html>