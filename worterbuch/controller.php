<?php
require "config.php";
date_default_timezone_set("Europe/Budapest");

$message = "";
$warning = "";

function highlight($haystack, $needle){
  $pos = strpos($haystack, $needle);
  $len = strlen($needle);
  return substr_replace($haystack,'<span style="background-color:#ff0;">'.$needle.'</span>',$pos,$len);
}

function getIdFrom($table,$db){
  $sql = "SELECT id FROM $table WHERE 1 ORDER BY id DESC LIMIT 1";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
    return $row['id'] + 1;
  }
  return 0;
}
// Create connection
$db = new mysqli(
  $config['servername'],
  $config['username'],
  $config['password'],
  $config['dbname']);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
//echo "Connected successfully";


$sql = "CREATE TABLE IF NOT EXISTS users(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  name VARCHAR(1024), 
  email VARCHAR(1024),
  password VARCHAR(1024), 
  token VARCHAR(1024),
  created VARCHAR(64))";
if (mysqli_query($db, $sql)) {
  //echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($db);
}

$sql = "CREATE TABLE IF NOT EXISTS words(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  name VARCHAR(1024), 
  lang VARCHAR(8),
  user_id INT(6),
  created VARCHAR(64))";
if (mysqli_query($db, $sql)) {
  //echo "Table words created successfully";
} else {
  echo "Error creating table: " . mysqli_error($db);
}

$sql = "CREATE TABLE IF NOT EXISTS pairs(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  left_word_id INT(6),
  right_word_id INT(6),
  left_example_id INT(6),
  right_example_id INT(6),
  user_id INT(6),
  created VARCHAR(64))";
if (mysqli_query($db, $sql)) {
  //echo "Table words created successfully";
} else {
  echo "Error creating table: " . mysqli_error($db);
}

$sql = "CREATE TABLE IF NOT EXISTS examples(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  example VARCHAR(1024),
  lang VARCHAR(8),
  user_id INT(6),
  created VARCHAR(64))";
if (mysqli_query($db, $sql)) {
  //$message .= "Table examples created successfully.<br>";
} else {
  echo "Error creating table: " . mysqli_error($db);
}

$created = date('Y-m-d H:i:s');



$MIN_WORD_LENGTH = 3;

$token = "";

if(isset($_POST['token'])){
  $token = $_POST['token'];
}elseif(isset($_GET['token'])){
  $token = $_GET['token'];
}

if($token != ""){
  $sql = "SELECT id,name FROM users WHERE token=\"$token\"";
  $res = $db->query($sql);
  $i = 0;
  while($row = $res->fetch_assoc()){
    $user_name = $row["name"];
    $user_id = $row["id"];
    $i++;
  }
  if($i==0){
    $token = "";
  }
}

if(isset($_GET['action']) and $_GET['action'] == 'addpair' and $token != ''){
  $left_word_id = $_GET['id'];
  $right_word_id = $_GET['id2'];
  $id = getIdFrom('pairs',$db);
  $sql = "INSERT INTO pairs(id,left_word_id, right_word_id, left_example_id, right_example_id, user_id, created) VALUES($id,$left_word_id,$right_word_id,1,1,\"$user_id\",\"$created\")";
  $res = $db->query($sql);
  if($res){
    $message .= "Pair added.";
  }
}

if(isset($_GET['action']) and $_GET['action'] == 'deletepair'){
  $id = $_GET['id'];
  $sql = "DELETE FROM pairs WHERE id=$id";
  $res = $db->query($sql);
  if($res){
    $message .= "Pair deleted.";
  }
}

//this comes from index.php
if(isset($_POST['addword'])){
  $newword = $_POST['word'];
}

if(isset($_POST['action']) and $_POST['action'] == 'insertexample'){
  $name = $_POST['name'];
  $language = $_POST['language'];
  if($token != ""){
	$id = getIdFrom('examples',$db);
    $sql = "INSERT INTO examples(id,example,lang,user_id,created) VALUES($id,\"$name\",\"$language\",\"$user_id\",\"$created\")";
    $res = $db->query($sql);
    if($res){
      $message .= "Example <b>$name <img src=\"flags/$language.png\"></b> added.";
    }
  }
}

if(isset($_GET['action']) and $_GET['action'] == 'updateleftexample'){
  $id = $_GET['id'];
  $with = $_GET['with'];
  $sql = "UPDATE pairs SET left_example_id=$with WHERE id=$id";
  $res = $db->query($sql);
  if($res){
    $message .= "Example changed on left side.";
  }
}

if(isset($_GET['action']) and $_GET['action'] == 'updaterightexample'){
  $id = $_GET['id'];
  $with = $_GET['with'];
  $sql = "UPDATE pairs SET right_example_id=$with WHERE id=$id";
  $res = $db->query($sql);
  if($res){
    $message .= "Example changed on right side.";
  }
}

if(isset($_GET['action']) and ($_GET['action'] == 'addexample' or $_GET['action'] == 'updateleftexample' or $_GET['action'] == 'updaterightexample')){
  $id = $_GET['id'];
  $sql = "SELECT 
  table1.name AS left_name,
  table1.lang AS left_lang,
  table2.name AS right_name,
  table2.lang AS right_lang,
  table3.example AS left_example,
  table3.lang AS left_example_lang,
  table4.example AS right_example,
  table4.lang AS right_example_lang
  FROM
(SELECT words.name, words.lang FROM pairs JOIN words ON words.id = left_word_id WHERE pairs.id=$id) AS table1,
(SELECT words.name, words.lang FROM pairs JOIN words ON words.id = right_word_id WHERE pairs.id=$id) AS table2,
(SELECT examples.example, examples.lang FROM pairs JOIN examples ON examples.id = left_example_id WHERE pairs.id=$id) AS table3,
(SELECT examples.example, examples.lang FROM pairs JOIN examples ON examples.id = right_example_id WHERE pairs.id=$id) AS table4";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
	  $left_name = $row['left_name'];
	  $left_lang = $row['left_lang'];
	  $right_name = $row['right_name'];
	  $right_lang = $row['right_lang'];
	  $left_example = $row['left_example'];
	  $left_example_lang = $row['left_example_lang'];
	  $right_example = $row['right_example'];
	  $right_example_lang = $row['right_example_lang'];
  }
  $examples_left = array();
  $sql = "SELECT * FROM examples WHERE example LIKE '%$left_name%' AND lang='$left_lang'";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
    $row['example'] = highlight($row['example'],$left_name);
    array_push($examples_left,$row);
  }
  $examples_right = array();
  $sql = "SELECT * FROM examples WHERE example LIKE '%$right_name%' AND lang='$right_lang'";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
	  $row['example'] = highlight($row['example'],$right_name);
	  array_push($examples_right,$row);
  }
}

if(isset($_POST['newuser'])){
  $user_name = $_POST['name'];
  $email = $_POST['email'];
  $token = md5($user_name.$email.$created);
  $password = substr($token,0,8);
  $user_id = getIdFrom('users',$db);
  $sql = "INSERT INTO users(id,name,email,password,token,created) VALUES($user_id,\"$user_name\",\"$email\",\"$password\",\"$token\",\"$created\");";
  $db->query($sql);
  $res = $db->query($sql);
  if($res){
    $message .= "User <b>$user_name</b> added.";
  }
}elseif(isset($_POST['password'])){
  $password = $_POST['password'];
  $sql = "SELECT name, token FROM users WHERE password=\"$password\"";
  $res = $db->query($sql);
  $i = 0;
  while($row = $res->fetch_assoc()){
    $user_name = $row["name"];
    $token = $row["token"];
    $i++;
  }
  if($i==0){
    $warning .= "Wrong password";
  }
}elseif(isset($_POST['insertword'])){
  $name = $_POST['name'];
  $language = $_POST['language'];
  if($token != ""){
    $id = getIdFrom('words',$db);
    $sql = "INSERT INTO words(id,name,lang,user_id,created) VALUES($id,\"$name\",\"$language\",\"$user_id\",\"$created\")";
    $res = $db->query($sql);
    if($res){
      $message .= "Word <b>$name <img src=\"flags/$language.png\"></b> added.";
    }
  }
}

if(
  (isset($_GET['action']) and (
	$_GET['action'] == 'showword' or 
	$_GET['action'] == 'addpair' or 
	$_GET['action'] == 'deletepair' or
	$_GET['action'] == 'addpair')) or 
  
  (isset($_POST['action']) and 
	$_POST['action'] == 'insertexample')
  
  ){
  if(isset($_GET['id'])){
  	$id = $_GET['id'];
  }elseif(isset($_POST['id'])){
	$id = $_POST['id'];
  }else{
	echo "There is no passed word ID";
	die;
  }
  $sql = "SELECT name, lang FROM words WHERE id=\"$id\"";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
    $word = $row["name"];
    $lang = $row["lang"];
  }
  $pairs = array();
  $sql = "SELECT 
    table1.id,
	table1.name as tr_name,
    table1.lang as tr_lang,
    table2.id as tr_example_id,
    table2.example as tr_example,
    table2.lang as tr_example_lang,
    table3.id as example_id,
    table3.example,
    table3.lang as example_lang
FROM 
	(SELECT pairs.id, words.name, words.lang FROM pairs JOIN words ON words.id=right_word_id where left_word_id=$id) as table1,
	(SELECT examples.id, examples.example, examples.lang FROM pairs JOIN examples ON examples.id=right_example_id where left_word_id=$id) as table2,
    (SELECT examples.id, examples.example, examples.lang FROM pairs JOIN examples ON examples.id=left_example_id where left_word_id=$id) as table3
UNION
SELECT 
    table1.id,
	table1.name as tr_name,
    table1.lang as tr_lang,
    table2.id as tr_example_id,
    table2.example as tr_example,
    table2.lang as tr_example_lang,
    table3.id as example_id,
    table3.example,
    table3.lang as example_lang
FROM 
	(SELECT pairs.id, words.name, words.lang FROM pairs JOIN words ON words.id=left_word_id where right_word_id=$id) as table1,
	(SELECT examples.id, examples.example, examples.lang FROM pairs JOIN examples ON examples.id=left_example_id where right_word_id=$id) as table2,
    (SELECT examples.id, examples.example, examples.lang FROM pairs JOIN examples ON examples.id=right_example_id where right_word_id=$id) as table3";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
	if($row['tr_example_id'] != 1){
		$row['tr_example'] = highlight($row['tr_example'],$row['tr_name']);
	}
	if($row['example_id'] != 1){
		$row['example'] = highlight($row['example'],$word);
	}
    array_push($pairs,$row);
  }
  
  
}

if(isset($_GET['action']) and $_GET['action'] == 'statistic'){
  //Statistic
  $sql = "SELECT table1.a, table2.b, table3.c FROM (
    SELECT count(*) as a FROM words WHERE lang=\"ger\") as table1,(
    SELECT count(*) as b FROM words WHERE lang=\"hun\") as table2,(
    SELECT count(*) as c FROM words WHERE lang=\"eng\") as table3";
  $res = $db->query($sql);
  while($row = $res->fetch_assoc()){
      $hun = $row["b"];
      $ger = $row["a"];
      $eng = $row["c"];
  }
}
$export = "";
if(isset($_POST['action']) and $_POST['action'] == 'import'){
  $import = $_POST['csv'];
  $rows = explode("\n", $import);
  $mode = "none";
  foreach($rows as $row){
    if(trim($row) == "---users begin---"){
      $mode = "users";
      $db->query("DELETE FROM users WHERE id >= 0");
    }elseif($mode == "users"){
      if(trim($row) == "---users end---"){
        $mode = "none";
        $message .= "<br>";
      }else{
        $item = explode(",", $row);
        $id = $item[0];
        $name = $item[1];
        $email = $item[2];
        $password = $item[3];
        $token2 = $item[4];
        $created = $item[5];
        $sql = "INSERT INTO users(id,name,email,password,token,created) VALUES($id,\"$name\",\"$email\",\"$password\",\"$token2\",\"$created\");";
        $res = $db->query($sql);
        if($res){
          $message .= "User <b>$name</b> added. ";
        }
      }
    }elseif(trim($row) == "---words begin---"){
      $mode = "words";
      $db->query("DELETE FROM words WHERE id >= 0");
    }elseif($mode == "words"){
      if(trim($row) == "---words end---"){
        $mode = "none";
        $message .= "<br>";
      }else{
        $item = explode(",", $row);
        $id =   $item[0];
        $name = $item[1];
        $language = $item[2];
        $user_id2 = $item[3];
        $created = $item[4];
        $sql = "INSERT INTO words(id,name,lang,user_id,created) VALUES($id,\"$name\",\"$language\",\"$user_id2\",\"$created\");";
        $res = $db->query($sql);
        if($res){
          $message .= "Word <b>$name <img src=\"flags/$language.png\"></b> added. ";
        }
      }
    }elseif(trim($row) == "---pairs begin---"){
      $mode = "pairs";
      $db->query("DELETE FROM pairs WHERE id >= 0");
    }elseif($mode == "pairs"){
      if(trim($row) == "---pairs end---"){
        $mode = "none";
        $message .= "<br>";
      }else{
        $item = explode(",", $row);
        $id =   $item[0];
        $left_word_id = $item[1];
        $right_word_id = $item[2];
        $left_example_id = $item[3];
        $right_example_id = $item[4];
        $user_id2 = $item[5];
        $created = $item[6];
        $sql = "INSERT INTO pairs(id,left_word_id, right_word_id, left_example_id, right_example_id, user_id, created) VALUES($id,$left_word_id,$right_word_id,$left_example_id,$right_example_id,$user_id2,\"$created\")";
        $res = $db->query($sql);
        if($res){
          $message .= "Pair <b>$id</b> added. ";
        }
      }
    }elseif(trim($row) == "---examples begin---"){
      $mode = "examples";
      $db->query("DELETE FROM examples WHERE id >= 0");
    }elseif($mode == "examples"){
      if(trim($row) == "---examples end---"){
        $mode = "none";
        $message .= "<br>";
      }else{
        $item = explode(",", $row);
        $id =   $item[0];
        $example = $item[1];
        $language = $item[2];
        $user_id2 = $item[3];
        $created = $item[4];
        $sql = "INSERT INTO examples(id,example,lang,user_id,created) VALUES($id,\"$example\",\"$language\",\"$user_id2\",\"$created\")";
        $res = $db->query($sql);
        if($res){
          $message .= "Example <b>$example <img src=\"flags/$language.png\"></b> added. ";
        }
      }
    }
  }
}elseif(isset($_GET['action']) and $_GET['action'] == 'export'){
  $export .= export_table("users",$db);
  $export .= export_table("words",$db);
  $export .= export_table("pairs",$db);
  $export .= export_table("examples",$db);
}

function export_table($table, $db){
  $sql = "SELECT * FROM $table";
  $res = $db->query($sql);
  $export = "---$table begin---\n";
  while($row = $res->fetch_assoc()){
    $i = 1;
    foreach($row as $item){
      $export .= $item;
      if($i != count($row)){
        $export .= ",";
      }
      $i++;
    }
    $export .= "\n";
  }
  $export .= "---$table end---\n";
  return $export;
}

//API
if(isset($_GET['getwords'])){
  $search = $_GET['getwords'];
  $sql = "SELECT id, name, lang FROM words WHERE name LIKE \"$search%\"";
  $res = $db->query($sql);
  $response = array();
  $rows = array();
  while( $row = $res->fetch_assoc()){
    $row_tidy = array();
    $row_tidy['id'] = $row['id'];
    $row_tidy['word'] = $row['name'];
    $row_tidy['lang'] = $row['lang'];
    
    array_push($rows,$row_tidy);
  }
  $response['result'] = $rows;
  
  echo json_encode($response);
  die;
}



if($token == ""){
  $token_path = "";
}else{
  $token_path = "&token=".$token;
}
  
?>
