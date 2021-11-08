<?php
require 'connect.php';
require 'functions.php';

$hashcode="";//initial value

// sql to create the user table
$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    password VARCHAR(64) NOT NULL,
    email VARCHAR(50),
    hashcode VARCHAR(64) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($conn->query($sql) === TRUE) {
    //$message .= "Table Users created successfully <br>";
  } else {
    //echo "Error creating table: " . $conn->error;
  }

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT hashcode FROM Users WHERE hashcode='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $hashcode = $row["hashcode"];
        }
    }
}

if (isset($_POST["name"],$_POST['password'],$_POST["submit"]) and $_POST['submit'] == 'Login') {
    //echo '<br>Check login';
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $sql = "SELECT hashcode FROM Users WHERE name='$name' AND password='$password'";
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $hashcode = $row["hashcode"];
        }
    }
}

if (isset($_POST["name"],$_POST['password'],$_POST['passwordagain'],$_POST['email'],$_POST['submit']) and 
    $_POST['password'] == $_POST['passwordagain'] and $_POST['email'] and $_POST['submit'] == 'Register') {
    //echo '<br>Register users';
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $hashcode = md5($name.$password.$email);
    //Check does user exist
    //Check password is same
    //Check is mail valid
    //Insert user
    $sql = "INSERT INTO Users (name, password, email, hashcode) VALUES ('$name', '$password', '$email', '$hashcode')";
    if ($conn->query($sql) === TRUE) {
        $amount = 0;
        $comment = 'Welcome user';
        $user_id = getUserId($hashcode, $conn);
        $sql = "INSERT INTO Expenses (amount, comment, user_id) VALUES ('$amount', '$comment', '$user_id')";
        if ($conn->query($sql) === TRUE) {
            $message .= "Expense added<br>";
        } else {
            $message .= "Expense not added<br>";
        }
    }
    $message .= "User added<br>";

}



mysqli_close($conn); 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Expenses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <script>var hashcode = '<?php echo $hashcode; ?>';</script>
</head>

<body onload="onload2()">
    <header class="w3-container w3-teal">
        <h1>Expenses</h1>
    </header>

    <div id="form" class="w3-container w3-margin">

        <div id="success" class="w3-panel w3-green w3-display-container">
            <span onclick="closeSuccess()" class="w3-button w3-large w3-display-topright">×</span>
            <h3>Success</h3>
            <p>You are logged in</p>
        </div>

        <div class="w3-container" id="expense">
            <div class="w3-card">

                <div class="w3-container w3-orange">
                    <h2>Expense</h2>
                </div>

                <div class="w3-container w3-padding w3-margin">
                    <label>Amount</label>
                    <input class="w3-input w3-border" type="number" id="amountExpense">
                    <label>Comment</label>
                    <input class="w3-input w3-border" type="text" id="commentExpense">
                    <button class="w3-btn w3-blue w3-margin" onclick="expense()">Send</button>
                </div>

            </div>

            <div class="w3-container w3-margin">
                <button class="w3-btn w3-green" onclick="openIncome()">Income</button>
            </div>
        </div>

        <div class="w3-container" id="income">
            <div class="w3-container w3-margin">
                <button class="w3-btn w3-orange" onclick="openExpense()">Expense</button>
            </div>
            <div class="w3-card">

                <div class="w3-container w3-green">
                    <h2>Income</h2>
                </div>

                <div class="w3-container w3-padding w3-margin">
                    <label>Amount</label>
                    <input class="w3-input w3-border" type="number" id="amountIncome">
                    <label>Comment</label>
                    <input class="w3-input w3-border" type="text" id="commentIncome">
                    <button class="w3-btn w3-blue w3-margin" onclick="income()">Send</button>
                </div>

            </div>

        </div>
        <!--here comes the list-->
        <div class="w3-container">
            <ul class="w3-card w3-ul" id="list">
            </ul>
        </div>

        <!--Chart-->
        <div class="w3-container">
            <canvas id="myChart"></canvas>
        </div>

        <!--link buttons-->
        <!-- https://icon-icons.com/pack/Teamleader-Outline/2348 -->
        <div class="w3-container w3-margin">
            <a href="getcsv.php?id=<?php echo $hashcode; ?>"><img src="import_download_icon_143002.svg" height="50px"/></a>
            <img onclick="openImport()" style="cursor:pointer" src="export_icon_143019.svg" height="50px"/>
            <a href="app.php?id=<?php echo $hashcode; ?>"><img src="link_icon_142996.svg" height="50px"/></a>
        </div>

        <!--import-->
        <div id="import" class="w3-container w3-margin">
            <label>Paste your csv data here:</label>
            <textarea class="w3-input w3-border" id="csv_data"></textarea>
            <button class="w3-btn w3-blue w3-margin" onclick="importCSV()">Import</button>
        </div>
    </div>

    <div id="error" class="w3-container w3-margin">
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="closeError()"
                class="w3-button w3-large w3-display-topright">×</span>
            <h3>Error</h3>
            <p>You are not logged in</p>
        </div>
    </div>

    <div class="w3-hide">
        <li class="w3-bar" id="balance_row">
            <div class="w3-row">
                <div class="w3-quarter w3-container w3-right-align"></div>
                <div class="w3-quarter w3-container"></div>
                <div class="w3-quarter w3-container"></div>
                <div class="w3-quarter w3-container w3-right-align"></div>
            </div>
        </li>
    </div>

    <div id="loader">
        <div id="circle"></div>
    </div>

    <footer class="w3-container w3-dark-grey">
        <p id="version"></p>
    </footer>

    <script src="app20210418.js"></script>
</body>

</html>
