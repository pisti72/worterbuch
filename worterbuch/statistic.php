<?php
  require "header.php";
?>
  <h1>Statistic</h1>
  <p><img src="flags/ger.png"> German words: <?php echo $ger; ?></p>
  <p><img src="flags/hun.png"> Hungarian words: <?php echo $hun; ?></p>
  <p><img src="flags/eng.png"> English words: <?php echo $eng; ?></p>
  <form method="post" action="index.php">
    <input type="hidden" name="token" value="<?php echo $token;?>">
    <button type="submit" class="btn btn-primary">Back</button>
  </form>
