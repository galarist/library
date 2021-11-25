<?php
require '../controller/users.controller.php';
//session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/library/public/css/style.css">
    <link rel="shortcut icon" href="/library/public/img/favicon.ico" type="image/x-icon">
    <title>Add user</title>
</head>

<body>
    <?php include '../view/header.php' ?>

    <header>
        <?php echo "Welcome <span>", $_SESSION["username"], "</span>! <br> Permission: ", $_SESSION["permission"] ?>
    </header>
    <?php include('../view/footer.php'); ?>
    <?php
    if (isset($message)) {
        echo '<label class="textDanger">' . $message . '</label>';
    }
    ?>
    </div>
</body>

</html>