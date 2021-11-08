<?php
$db = new SQLite3('notes.db');
if (isset($_GET['action'])) {
  if($_GET['action'] == 'hello') {
    echo "Hello World";
  }elseif($_GET['action'] == 'adduser') {
    if(isset($_GET['name'], $_GET['email'])){
      $name = $_GET['name'];
      $email = $_GET['email'];
      $sql = "INSERT INTO user(name,email) VALUE(\"{$name}\",\"{$email}\");";
      echo $sql;
      $db->exec($sql);
    }
  }
}
$db->close();
?>
