<?php
//define('BASEPATH', true); //access connection script if you omit this line file will be blank
require '../model/conn.php'; //require connection script

if (isset($_POST['submit'])) {
    try {
        $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $fName = $_POST['firstName'];
        $lName = $_POST['lastName'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
        
        //Check if username exists
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row['num'] > 0) {
            echo '<script>alert("Username already exists")</script>';
        } else {
            $stmt = $dsn->prepare("INSERT INTO users (firstName, lastName, username, email, password) 
                    VALUES (:firstName, :lastName, :username, :email, :password)");
            $stmt->bindParam(':firstName', $fName);
            $stmt->bindParam(':lastName', $lName);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);
            if ($stmt->execute()) {
                echo '<script>alert("New account created.")</script>';
                //redirect to another page
                header("Location: /library/users/signin.php");
            } else {
                echo '<script>alert("An error occurred")</script>';
            }
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
        echo '<script type="text/javascript">alert("'.$error.'");</script>';
    }
}

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
            <label for="firstName"><b>First Name</b></label>
            <input type="text" required="required" name="firstName" placeholder="First Name">
            <label for="lastName"><b>Last Name</b></label>
            <input type="text" required="required" name="lastName" placeholder="Last Name">
            <label for="username"><b>Username</b></label>
            <input type="text" required="required" name="username" placeholder="Username">
            <label for="email"><b>Password</b></label>
            <input required="required" type="email" name="email" placeholder="Email">
            <label for="password"><b>Password</b></label>
            <input required="required" type="password" name="password" placeholder="Password">
            <button name="submit" type="submit">register</button>
            </div>
        </form>
    </div>
</body>

</html>