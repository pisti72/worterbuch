<?php
require "header.php";
?>
<form method="post">
  <div class="form-group mb-2">
    <textarea class="form-control" name="csv" rows="20"><?php echo $export; ?></textarea>
  </div>
  <div class="form-group mb-2">
    <input type="hidden" name="action" value="import">
    <button class="btn btn-primary" type="submit">Import</button>
  </div>
</form>
