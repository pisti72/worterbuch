<?php
  require "controller.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Worterbuch</title>
  </head>
  <body style="background-color:#eee;">
    <header class="p-3 mb-3 border-bottom" style="background-color:#55f;">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php?d=0<?php echo $token_path; ?>" class="nav-link px-2 text-white">
          <img src="assets/worterbuch_shadow.png">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php?d=0<?php echo $token_path; ?>" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="statistic.php?action=statistic<?php echo $token_path; ?>" class="nav-link px-2 text-white">Statistic</a></li>
          <li><a href="about.php?d=0<?php echo $token_path; ?>" class="nav-link px-2 text-white">About</a></li>
          <li><a href="export.php?action=export<?php echo $token_path; ?>" style="color:#55f;">x</a></li>
        </ul>
<?php
if($token == ""){
?>
        <form class="row mb-1 mb-lg-0 me-lg-3" action="index.php" method="post">
			<div class="col text-end text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
				  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
				</svg>
			</div>
			<input type="password" size="8" maxlength="8" class="form-control col" name="password"/>
        </form>
        
        <form class="text-end" action="register.php" method="post">
            <button type="submit" class="btn btn-light">Register</button>
        </form>
<?php
}else{
?>
        <!-- https://icons.getbootstrap.com/ -->
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="me-3" viewBox="0 0 16 16">
          <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        </svg>
        <p class="mb-2 justify-content-center text-white"><?php echo $user_name; ?></p>
<?php
}
?>
      </div>
    </div>
  </header>
  <div class="container">
<?php
if($warning != ""){
?>
      <div class="alert alert-danger" role="alert"><?php echo $warning; ?></div>
<?php
}elseif($message != ""){
?>
      <div class="alert alert-success" role="alert"><?php echo $message; ?></div>
<?php
}
?>
   
      
