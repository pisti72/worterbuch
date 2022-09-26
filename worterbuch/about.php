<?php
  require "header.php";
?>
  <h1>About</h1>
  <p>This is something different than other translation sites.</p>
  <p>Current PHP version: <?php echo phpversion() ?></p>
  <form method="post" action="index.php">
    <input type="hidden" name="token" value="<?php echo $token;?>">
    <button type="submit" class="btn btn-primary">Back</button>
  </form>
