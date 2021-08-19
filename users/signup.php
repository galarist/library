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
                 echo '<script>window.location.replace("/library/users/signin.php")</script>';
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

<form method="post">
    <input type="text" required="required" name="firstName" placeholder="First Name">
    <input type="text" required="required" name="lastName" placeholder="Last Name">
    <input type="text" required="required" name="username" placeholder="Username">
    <input required="required" type="email" name="email" placeholder="Email">
    <input required="required" type="password" name="password" placeholder="Password">
    <button name="submit" type="submit">register</button>
</form>