<?php
  require "header.php";
?>
  <h1>Add new word</h1>
  <form method="post" action="index.php">
    <input type="text" class="form-control mb-3" value="<?php echo $newword;?>" name="name">
    <div class="form-check">
      <input class="form-check-input" type="radio" name="language" value="hun">
      <label class="form-check-label" ><img src="flags/hun.png"> Hungarian</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="language" value="eng">
      <label class="form-check-label" ><img src="flags/eng.png"> English</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="language" value="ger" checked>
      <label class="form-check-label" ><img src="flags/ger.png"> German</label>
    </div>
    <input type="hidden" name="token" value="<?php echo $token;?>">
    <button type="submit" class="btn btn-primary" name="insertword">Add</button>
  </form>
