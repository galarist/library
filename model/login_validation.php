<?php
    session_start();
    include_once 'model/conf.php';
    $msg = "";
    if (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($username != "" && $password != "") {
            try {
                $query = "select * from `users` where `username`=:username and `password`=:password";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam('username', $username, PDO::PARAM_STR);
                $stmt->bindValue('password', $password, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($count == 1 && !empty($row)) {
                    /******************** Your code ***********************/
                    $_SESSION['sess_user_id'] = $row['uid'];
                    $_SESSION['sess_user_name'] = $row['username'];
                    $_SESSION['sess_name'] = $row['name'];
                    header('./');

                } else {
                    $msg = "Invalid username and password!";
                }
            } catch (PDOException $e) {
                echo "Error : ".$e->getMessage();
            }
        } else {
            $msg = "Both fields are required!";
        }
    }
?>