<?php 
  if(isset($_SESSION["username"])) {
    ?>
    <ul>
      <li><a class="active" href=".">Home</a></li>
      <li><a href="signout.php">Sign Out</a></li>
      <li><a href="dashboard.php">Admin</a></li>
    </ul>
    <?php
  } else {
    ?>
    <ul>
      <li><a class="active" href=".">Home</a></li>
      <li><a href="signin.php">Sign In</a></li>
      <li><a href="signup.php">Sign Up</a></li>
    </ul>
    <?php 
  }
?>

