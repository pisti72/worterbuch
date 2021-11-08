<?php
$env = 'dev';
//$env = 'prod';

if($env == 'dev') {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sohervagyok";
}elseif($env == 'prod') {
  $servername = "sql207.epizy.com";
  $username = "epiz_26088689";
  $password = "O4jqF15BOj";
  $dbname = "epiz_26088689_soher";
}
$message = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$message .= "Connected successfully<br>";
?>