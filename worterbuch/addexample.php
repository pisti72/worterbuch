<?php
  require "header.php";
?>
  <h1>Example editor</h1>
  
  <div class="row">
	  <div class="col"><b><?php echo $left_name; ?></b>&nbsp;<img src="flags/<?php echo $left_lang; ?>.png"></div>
	  <div class="col"><b><?php echo $right_name; ?></b>&nbsp;<img src="flags/<?php echo $right_lang; ?>.png"></div>
  </div>
  <div class="rounded m-1 p-2 text-center fs-5" style="background-color:#ccc;">
    Current example sentences:
  </div>
  <div class="row">
    <div class="col">
	  <div class="rounded m-1 p-2" style="background-color:#ddd;">
	    <?php echo $left_example; ?>
      </div>
    </div>
    <div class="col">
	  <div class="rounded m-1 p-2" style="background-color:#ddd;">
	    <?php echo $right_example; ?>
      </div>
    </div>
  </div>
  <div class="rounded m-1 p-2 text-center fs-5" style="background-color:#ccc;">
    Available example sentences:
  </div>
  <div class="row">
	  <div class="col">
<?php
  foreach ($examples_left as $example) {
?>  
  <div class="rounded m-1 p-2" style="background-color:#ddd;">
    <?php echo $example['example']; ?>
    <div class="text-end">
	  <a href="?action=updateleftexample&id=<?php echo $id; ?>&with=<?php echo $example['id']; ?>&token=<?php echo $token; ?>">
	    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
		  <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
		  <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
	    </svg>
	  </a>
	</div>
  </div>
<?php
  }
?>
	  
	  </div>
	  <div class="col">
<?php
  foreach ($examples_right as $example) {
?>  
  <div class="rounded m-1 p-2" style="background-color:#ddd;">
    <?php echo $example['example']; ?>
    <div class="text-end">
	  <a href="?action=updaterightexample&id=<?php echo $id; ?>&with=<?php echo $example['id']; ?>&token=<?php echo $token; ?>">
	    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
		  <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
		  <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
	    </svg>
	  </a>
	</div>
  </div>
<?php
  }
?>	  
	  
	  </div>
  </div>
  <form method="post" action="addexample.php">
    <input type="text" class="form-control mb-3 mt-3" name="name">
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
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>"> 
    <input type="hidden" name="action" value="insertexample"> 
    <button type="submit" class="btn btn-primary">Add new example</button>
  </form>
