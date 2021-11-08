<?php
require 'connect.php';

if(isset($_GET['id'])) {
    $token = $_GET['id'];
    $sql = "SELECT e.amount, e.comment, e.reg_date FROM Expenses e JOIN Users u ON u.id = e.user_id WHERE u.hashcode='$token' ORDER BY e.reg_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo '"amount","comment","date"<br>';
        while($row = $result->fetch_assoc()) {
            echo '"'.$row['amount'].'","'. $row['comment'].'","'.$row['reg_date'].'"<br>';
        }
    }
}else{
    echo "Sorry no csv";
}