<!doctype html>
<html>

<head>
    <title>Control Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="w3.css">
    <script src="https://kit.fontawesome.com/a18cbd3810.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <meta charset="UTF-8">
</head>

<body>
    <div class="w3-container">
        <h1>Timer control</h1>
        <h2 id="name"></h2>
        <img id="connection" src="assets/sad_cloud_01.svg" height="50px"/>
        <div class="w3-container w3-border w3-round w3-center">
            <div id="timestring" class="w3-margin">NO CONNECTION</div>
            <div id="message" class="w3-margin">...</div>
            <button class="w3-button w3-blue w3-round w3-hover-red w3-margin" onclick="playPressed()" id="play">
                <i class="fas fa-play"></i> Play</button>
            <button class="w3-button w3-blue w3-round w3-hover-red w3-margin" onclick="pausePressed()" id="pause">
                <i class="fas fa-pause"></i> Pause</button>
            <button class="w3-button w3-blue w3-round w3-hover-red w3-margin" onclick="setToZero()">
                <i class="fa fa-step-backward"></i> Restart</button>
            <button class="w3-button w3-blue w3-round w3-hover-red w3-margin" onclick="setOneHour()">
                <i class="fas fa-stopwatch"></i> Start 1 hour</button>
            <button class="w3-button w3-blue w3-round w3-hover-red w3-margin" onclick="decFiveMins()">
                <i class="fas fa-minus-square"></i> - 5 mins</button>
            <button class="w3-button w3-blue w3-round w3-hover-red w3-margin" onclick="addFiveMins()">
                <i class="fas fa-plus-square"></i> + 5 mins</button>
        </div>
    </div>
    
    <script>
    var id = '<?php echo ($_GET['id']); ?>';
    </script>
    <script src="control.js"></script>
</body>

</html>
