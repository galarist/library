<?php 
if(isset($_SESSION["username"])) {
    ?>
    <ul>
        <li><a class="active" href="/library">Home</a></li>
        <li><a href="/library/mvc/controller/users/signout.php">Sign Out</a></li>
        <?php echo ($_SESSION["permission"] == 1) ? '<li><a href="/library/mvc/view/authors.php">Authors</a></li><li><a href="/library/mvc/controller/users/signup.php">Add User</a></li><li><a href="/library/users/dashboard.php">Dashboard</a></li>' : '' ?>
    </ul>
    <?php } else { ?>
    <ul>
        <li><a class="active" href="/library">Home</a></li>
        <?php /*If user is not set display Sign In*/ echo (!isset($_SESSION['username'])) ? '<li><a href="/library/mvc/view/authors.php">Authors</a></li><li><a href="/library/mvc/controller/users/signin.php">Sign In</a></li>' : '' ?>
    </ul>
    <?php 
}
?>

