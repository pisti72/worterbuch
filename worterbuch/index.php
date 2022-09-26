<?php
  require "header.php";
?>
  <input type="text" class="form-control mb-3 mt-5" id="word" placeholder="Search for a word" onblur="typing()">
  <div id="result"></div>
<?php
  if($token != ""){
?>
  <form method="post" action="addword.php">
    <button type="submit" class="btn btn-primary" name="addword">Add new word</button>
    <input type="hidden" name="token" id="token" value="<?php echo $token;?>">
    <input type="hidden" name="word" id="newword">
  </form>
<?php
  }
?>
  <script src="worterbuch.js"></script>
  
