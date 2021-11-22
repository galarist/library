<?php
require '../model/conn.php'; // Connection script
if (isset($_POST['submit'])) {
    try {
        $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Input field call + sanitize
        $fName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
        $lName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
        $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pwd = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $permission = filter_var($_POST['permission'], FILTER_SANITIZE_NUMBER_INT);
        // Increase the default cost for BCRYPT to 12
        // Also switched to 60 characters (BCRYPT)
        $pwd = password_hash($pwd, PASSWORD_BCRYPT, array("cost" => 12));
        
        // Check if username exists
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(trim($permission) == '' || !isset($fName) || trim($lName) == '' || trim($user) == '' || trim($email) == '' || trim($pwd) == '')
        {
            $message = "You did not fill out the fields.";
        } 
        elseif ($row['num'] > 0) {
            $message = "Username already exists";
        } else {
            // Create user
            $stmt = $dsn->prepare("INSERT INTO users (permission, firstName, lastName, username, email, password) 
                    VALUES (:permission, :firstName, :lastName, :username, :email, :password)");
            // Binds a parameter to the specified variable name
            $stmt->bindParam(':firstName', $fName);
            $stmt->bindParam(':lastName', $lName);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pwd);
            $stmt->bindParam(':permission', $permission);
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