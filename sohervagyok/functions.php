<?php
function getUserId($token, $conn) {
    //Get user by token
    $sql = "SELECT id FROM Users WHERE hashcode='$token'";
    //echo $sql;
    $result = $conn->query($sql);
    $id = '';
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
        }
    }
    return $id;
  }
?>