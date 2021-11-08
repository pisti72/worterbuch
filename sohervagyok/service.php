<?php
require 'connect.php';
require 'functions.php';

function getHistory($id, $conn) {
  //Get the list by user
  $sql = "SELECT amount, comment, reg_date FROM Expenses WHERE user_id='$id' ORDER BY reg_date DESC";
  $result = $conn->query($sql);
  $array = array();
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          unset($element);
          $element=array();
          $element["amount"] = $row["amount"];
          $element["comment"] = $row["comment"];
          $element["date"] = $row["reg_date"];
          $array[] = $element;
      }
  }
  return $array;
}

$_POST = json_decode(file_get_contents('php://input'), true);
 
$response = array("success" => FALSE);

//$response->success = FALSE;



// sql to create table
if(isset($_POST['token'])){
  $sql = "CREATE TABLE IF NOT EXISTS Expenses (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      amount VARCHAR(30) NOT NULL,
      comment VARCHAR(64),
      user_id INT(6) NOT NULL,
      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )";

  if ($conn->query($sql) === TRUE) {
    $sql = "SELECT * FROM Expenses WHERE 1";
    $result = $conn->query($sql);
    if($result->num_rows == 0) {
      $amount = 0;
      $comment = 'Welcome user';
      $token = $_POST['token'];
      $user_id = getUserId($token, $conn);
      $sql = "INSERT INTO Expenses (amount, comment, user_id) VALUES ('$amount', '$comment', '$user_id')";
        if ($conn->query($sql) === TRUE) {
            $message .= "Expense added<br>";
        } else {
            $message .= "Expense not added<br>";
        }
      }
    //$message .= "Table Users created successfully <br>";
  } else {
    //echo "Error creating table: " . $conn->error;
  }
}

if (isset($_POST["amount"], $_POST['token'], $_POST['comment'], $_POST['command']) and $_POST['command'] == 'expense') {
  $response['success'] = 'inserted';
  $amount = $_POST['amount'];
  $token = $_POST['token'];
  $comment = $_POST['comment'];
  $user_id = getUserId($token, $conn);

  if($user_id != '') {
    //Insert user
    $sql = "INSERT INTO Expenses (amount, comment, user_id) VALUES ('-$amount', '$comment', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        $message .= "Expense added<br>";
    } else {
        $message .= "Expense not added<br>";
    }
  }
}

if (isset($_POST["amount"], $_POST['token'], $_POST['comment'], $_POST['command']) and $_POST['command'] == 'income') {
  $response['success'] = 'inserted';
  $amount = $_POST['amount'];
  $token = $_POST['token'];
  $comment = $_POST['comment'];
  $user_id = getUserId($token, $conn);

  if($user_id != '') {
    //Insert user
    $sql = "INSERT INTO Expenses (amount, comment, user_id) VALUES ('$amount', '$comment', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        $message .= "Income added<br>";
    } else {
        $message .= "Income not added<br>";
    }
  }
}

if (isset($_POST["csvdata"], $_POST['token'], $_POST['command']) and $_POST['command'] == 'import') {
  $response['success'] = 'csv not imported';
  $csvdata = $_POST['csvdata'];
  $token = $_POST['token'];

  $user_id = getUserId($token, $conn);

  if($user_id != '') {
    $rows = str_getcsv($csvdata, "\n");
    $sql = "DELETE FROM Expenses WHERE user_id='$user_id';";
    $conn -> query($sql);
    for($i=1;$i<count($rows);$i++){
      $cells = str_getcsv($rows[$i], ",");
      if (count($cells)==3){
        $amount = $cells[0];
        $comment = $cells[1];        
        $date = $cells[2];
        
        $sql = "INSERT INTO Expenses (amount, comment, user_id, reg_date) VALUES ('$amount', '$comment', '$user_id', '$date');";
        
        if ($conn -> query($sql) === TRUE) {
            $response['success'] = "Csv imported all rows";
        } else {
            $response['error'] = "Error description: " . $conn -> error;
        }
      }
    }
  }
}

if (isset($_POST["token"], $_POST["command"]) and $_POST["command"] == "history") {
  $response['success'] = 'got history';
  $token = $_POST['token'];
  $user_id = getUserId($token, $conn);
  $response['items'] = getHistory($user_id, $conn);
  
}

$response['message'] = $message;

echo json_encode($response);

?>
