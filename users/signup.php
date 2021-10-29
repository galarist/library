<?php
require '../model/conn.php'; // Connection script
if (isset($_POST['submit'])) {
    try {
        $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Input field call
        $fName = $_POST['firstName'];
        $lName = $_POST['lastName'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        // Increase the default cost for BCRYPT to 12
        // Also switched to 60 characters (BCRYPT)
        $pwd = password_hash($pwd, PASSWORD_BCRYPT, array("cost" => 12));
        
        // Check if username exists
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!isset($fName) || trim($lName) == '' || trim($user) == '' || trim($email) == '' || trim($pwd) == '')
        {
            $message = "You did not fill out the fields.";
        } 
        elseif ($row['num'] > 0) {
            $message = "Username already exists";
        } else {
            // Create user
            $stmt = $dsn->prepare("INSERT INTO users (firstName, lastName, username, email, password) 
                    VALUES (:firstName, :lastName, :username, :email, :password)");
            // Binds a parameter to the specified variable name
            $stmt->bindParam(':firstName', $fName);
            $stmt->bindParam(':lastName', $lName);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pwd);
            if ($stmt->execute()) {
                $message = "New account created.";
            } else {
                $message = "An error occurred!";
            }
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
        $message = $error;
    }
}
    session_start();
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
                <label for="email"><b>Password</b></label>
                <input type="email" name="email" placeholder="Email">
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" placeholder="Password">
                <button name="submit" type="submit">register</button>
            </div>
        </form>
        <?php
            if (isset($message)) {
                echo '<label class="textDanger">'.$message.'</label>';
            }
        ?>
    </div>
</body>

</html>