<?php
  require "header.php";
?>
  <h1>Your password</h1>
   <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Token info</h5>
        <p class="card-text">Save your password carefully before closing this window!</p>
        <form action="index.php" method="post">
          <input type="text" class="form-control mb-3" value="<?php echo $password;?>">
          <button type="submit" class="btn btn-primary" >Close</button>
          <input type="hidden" name="token" value="<?php echo $token;?>">
        </form>
      </div>
    </div>
