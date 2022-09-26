<?php
  require "header.php";
?>
  <h1>Register a new user</h1>
  <form action="yourtoken.php" method="post">
      <input type="text" class="form-control mb-3" placeholder="Your nick name" name="name">
      <input type="email" class="form-control mb-3" placeholder="Your email address" name="email">
      <button type="submit" class="btn btn-primary" name="newuser">Submit</button>
  </form>