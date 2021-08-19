<?php 
  if(isset($_SESSION["username"])) {
    ?>
    <ul>
      <li><a class="active" href="/library">Home</a></li>
      <li><a href="/library/users/signout.php">Sign Out</a></li>
      <li><a href="/library/users/dashboard.php">Dashboard</a></li>
    </ul>
    <?php
  } else {
    ?>
    <ul>
      <li><a class="active" href="/library">Home</a></li>
      <li><a href="/library/users/signin.php">Sign In</a></li>
      <li><a href="/library/users/signup.php">Sign Up</a></li>
    </ul>
    <?php 
  }
?>

