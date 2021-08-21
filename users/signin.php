<?php
session_start();
require '../model/conn.php'; // Connection script
try {
    if (isset($_POST['login'])) {
        $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Ensure fields are not empty
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $pwd = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
        // Retrieve the user account information for the given username.
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
    
        // Bind value.
        $stmt->bindValue(':username', $username);
    
        // Execute.
        $stmt->execute();
    
        // Fetch row.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Checks if $row is FALSE.
        if ($user === false) {
            $message = '<label>Wrong username/password</label>';
        } else {
        // Compare and decrypt passwords.
            $checking = password_verify($pwd, $user['password']);
            // If password verification is TRUE, the login has been successful.
            if ($checking) {
                // Provide the user with a login session.
                $_SESSION['username'] = $username;
                $username = $_SESSION['username'];
                // Make a session for permission
                $stmt->execute();
                $results = $stmt->fetchAll();
                foreach ($results as $key) {
                    $_SESSION["permission"] = $key['permission'];
                    if (isset($_SESSION["username"]) && $key['permission'] == '1') {
                        header("Location: dashboard.php");
                    } else {
                        header("Location: /library");
                    }
                }
                exit;
            } else {
                // Otherwise, the password does not match.
                $message = '<label>Wrong username/password</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
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
    <?php include '../view/header.php'?>
    <div class="container">
        <?php
            if (isset($message)) {
                echo '<label class="textDanger">'.$message.'</label>';
            }

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