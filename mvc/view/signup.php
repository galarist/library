<?php
require '../controller/users.controller.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/library/public/css/style.css">
    <link rel="shortcut icon" href="/library/public/img/favicon.ico" type="image/x-icon">
    <title>Sign In</title>
</head>

<body>
    <?php include '../view/header.php'?>
    <div class="container">
        <form method="post">
            <div class="container">
                <label for="firstName"><b>First Name</b></label>
                <input type="text" name="firstName" placeholder="First Name">
                <label for="lastName"><b>Last Name</b></label>
                <input type="text" name="lastName" placeholder="Last Name">
                <label for="username"><b>Username</b></label>
                <input type="text" name="username" placeholder="Username">
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" placeholder="Email">
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" placeholder="Password">
                <label for="permission"><b>Permission</b></label>
                <input type="text" name="permission" placeholder="1 or 0">
                <button name="submit" type="submit">register</button>
            </div>
        </form>
        <?php
            if (isset($message)) {
                echo '<label class="textDanger">'.$message.'</label>';
            }

            // Only admin can register
            if (!isset($_SESSION["username"]) && $_SESSION['permission'] !== '1') {
                header('Location: ../');
            }
            
        ?>
    </div>
</body>

</html>