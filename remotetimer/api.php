<?php

include 'config.php';

$response = array();

global $mysqli;
$mysqli = new mysqli(
    $config[$env]['host'],
    $config[$env]['user'], 
    $config[$env]['password'],
    $config[$env]['database'],
    $config[$env]['port']);

/* check connection */
if (mysqli_connect_errno()) {
    //printf("Connect failed: %s\n", mysqli_connect_error());
    $response['result'] = 'failed';
    exit();
} else {
    //printf("Connected");
}

/*
Request timer
called by timer
 */
$response['result'] = 'failed';

//called by control and timer at 1st
if (isset($_GET['timer'])) {
    $token = $_GET['timer'];
    $query = "SELECT name, command, timestring, style FROM remotetimer_timers WHERE token = '$token'";
    if ($result = $mysqli->query($query)) {
        /* fetch object array */
        if ($row = $result->fetch_row()) {
            $response['result'] = 'success';
            $response['name'] = $row[0];
            $response['command'] = $row[1];
            $response['timestring'] = $row[2];
            $response['style'] = $row[3];
            $result->close();
        } else {
            $response['result'] = 'failed';
        }
    }
}
//called by timer
if (isset($_GET['timestring'], $_GET['receivedcommand'], $_GET['token'])) {
    $token = $_GET['token'];
    $timestring = $_GET['timestring'];
    $command = $_GET['receivedcommand'];
    $query = "SELECT command FROM remotetimer_timers WHERE token = '$token'";
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($result = $mysqli->query($query)) {
        if ($row = $result->fetch_row()) {
            $response['result'] = 'success';
            if ($row[0] == $command) {
                $query = "UPDATE remotetimer_timers SET timestring = '$timestring', command='NOPE', client = '$ip' WHERE token ='$token'";
                $success = $mysqli->query($query);
                if ($success) {
                    $response['result'] = 'success';
                } else {
                    $response['result'] = 'failed';
                }
            } else {
                $response['result'] = 'failed';
            }
            $result->close();
        } else {
            $response['result'] = 'failed';
        }
    }
}

//called by control
if (isset($_GET['command'], $_GET['token'])) {
    $token = $_GET['token'];
    $command = $_GET['command'];
    $query = "UPDATE remotetimer_timers SET command = '$command' WHERE token ='$token'";
    $success = $mysqli->query($query);
    if ($success) {
        $response['result'] = 'success';
    } else {
        $response['result'] = 'failed';
    }
}

//called by god
if (isset($_GET['all'])) {
    $array = array();
    $query = "SELECT name, timestring, token FROM remotetimer_timers WHERE user_id IS NOT NULL";
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_row()) {
            $elem['name'] = $row[0];
            $elem['time'] = $row[1];
            $elem['token'] = $row[2];
            array_push($array, $elem);
        }
        $response['result'] = 'success';
        $response['timers'] = $array;
    }else {
        $response['result'] = 'failed';
    }
}

//called by user registration
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
if (isset($data)) {
    //new user
    if (isset($data->name, $data->email, $data->password)) {
        $token = substr(md5($data->name . $data->email . $data->password), 0, 16);
        $password = md5($data->password);
        $email = $data->email;
        $name = $data->name;
        $query = "INSERT INTO remotetimer_users (name,password,email,token)VALUES('$name','$password','$email','$token')";
        //$response['sql'] = $query;
        $success = $mysqli->query($query);
        if ($success) {
            $response['result'] = 'success';
        } else {
            $response['result'] = 'failed';
        }
        //$response['name'] = $data->name;
    }
    //login user
    if (isset($data->name, $data->password)) {
        $password = md5($data->password);
        $name = $data->name;
        $id = 9999;
        $query = "SELECT id, name, token FROM remotetimer_users WHERE (name = '$name' OR email = '$name') AND password='$password'";
        if ($result = $mysqli->query($query)) {
            if ($row = $result->fetch_row()) {
                $response['result'] = 'success';
                $id = $row[0];
                $response['name'] = $row[1];
                $response['token'] = $row[2];
            }
            $tokens = array();
            $names = array();
            $query = "SELECT name, token FROM remotetimer_timers WHERE user_id = '$id'";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_row()) {
                    array_push($names, $row[0]);
                    array_push($tokens, $row[1]);
                }
                $response['timers'] = $tokens;
                $response['names'] = $names;
            }
        } else {
            $response['result'] = 'failed';
        }
    }
}

if(isset($_GET['hash'])){
    $response['result'] = 'success';
    $response['number'] = getHash18();
}

function getHash18() {
    $n = '';
    for($i=0;$i<18;$i++){
        $rand = rand(0,35);
        if($rand>=0 && $rand<=9){
            $rand += 48;
        }else{
            $rand += 55;
        }
        $n .= chr($rand);
    }
    return $n;
}

/* send back the result */
echo json_encode($response);

/* close connection */
$mysqli->close();
