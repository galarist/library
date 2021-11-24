<?php
require '../controller/users.controller.php';
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
    <div class="container">
        <form method="post">
            <div class="container">
                <label for="firstName"><b>First Name</b></label>
                <input type="text" name="firstName" maxlength="40" pattern="[A-Za-z]{2,}" placeholder="First Name">
                <label for="lastName"><b>Last Name</b></label>
                <input type="text" name="lastName" maxlength="40" pattern="[A-Za-z]{2,}" placeholder="Last Name">
                <label for="username"><b>Username</b></label>
                <input type="text" name="username" required="required" maxlength="40" pattern="[A-Za-z]{2,}" placeholder="Username">
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email">
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" required="required" pattern=".{8,}" title="Eight or more characters" placeholder="Password">
                <label for="permission"><b>Permission</b></label>
                <input type="text" name="permission" required="required" pattern="(^|\\s)(^.[0-1]{1})" minlength="1" title="Please use 0 or 1" placeholder="1 or 0">
                <button name="submit" type="submit">register</button>
            </div>
        </form>
        <?php
        if (isset($message)) {
            echo '<label class="textDanger">' . $message . '</label>';
        }

        // Only admin can register
        if (!isset($_SESSION["username"]) && $_SESSION['permission'] !== '1') {
            header('Location: ../../');
        }

        ?>
    </div>
</body>

</html>