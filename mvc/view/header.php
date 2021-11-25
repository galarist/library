<?php
// check for logged in user
if (isset($_SESSION["username"])) {
?>
    <ul>
        <li><a class="active" href="/library">Home</a></li>
        <li><a href="/library/mvc/view/profile.php">Profile</a></li>
        <li><a href="/library/mvc/controller/users.controller.php?logout">Sign Out</a></li>
        <?php echo ($_SESSION["permission"] == 1) ? '<li><a href="/library/mvc/view/signup.php">Add User</a></li><li><a href="/library/mvc/view/dashboard.php">Dashboard</a></li>' : '' ?>
    </ul>
<?php } else { ?>
    <ul>
        <li><a class="active" href="/library">Home</a></li>
        <?php /*If user is not set display Sign In*/ echo (!isset($_SESSION['username'])) ? '<li><a href="/library/mvc/view/authors.php">Authors</a></li><li><a href="/library/mvc/view/signin.php">Sign In</a></li>' : '' ?>
    </ul>
<?php
}
?>