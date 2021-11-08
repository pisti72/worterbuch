const api = './api.php';
const tick = 100;
var counter = 0;
var endTime = 0;
var paused = false;

hide('play');
window.requestAnimationFrame(update);

function checkServer() {
    if (counter % tick == 0) {
        fetch(api + '?timer=' + id).then(function (response) {
            return response.json()
        }).then(function (json) {
            f('name').innerHTML = json.name;
            setEndTime(json.timestring);
            if(json.result == 'success'){
                hide('connection');
            }else{
                visible('connection');
            }
            
            //console.log(json.command);
            if(json.command != 'NOPE'){
                f('message').innerHTML = 'Sending command...';
                if(json.command == 'SETONEHOUR'){
                    f('message').innerHTML = 'Setting one hour';
                }else if(json.command == 'DECFIVEMINS'){
                    f('message').innerHTML = 'Decreasing 5 mins';
                }else if(json.command == 'ADDFIVEMINS'){
                    f('message').innerHTML = 'Adding 5 mins';
                }else if(json.command == 'SETTOZERO'){
                    f('message').innerHTML = 'Stopping';
                }else if(json.command == 'PAUSED'){
                    f('message').innerHTML = 'Pausing';
                }else if(json.command == 'CONTINUE'){
                    f('message').innerHTML = 'Playing';
                }
            }else{
                f('message').innerHTML = '...';;
            }
        }).catch(function (error) {
            console.log(error);
            visible('connection');
        })
    }
}

function setOneHour() {
    paused = false;
    f('message').innerHTML = 'Set 1 hour pressed';
    fetch(api + '?command=SETONEHOUR&token=' + id).then().catch(function (error) {
        console.log(error)
    });
    visible('pause');
    hide('play');
}

function decFiveMins() {
    paused = false;
    f('message').innerHTML = 'Decreasing 5 minutes pressed';
    fetch(api + '?command=DECFIVEMINS&token=' + id).then().catch(function (error) {
        console.log(error)
    });
    visible('pause');
    hide('play');
}

function addFiveMins() {
    paused = false;
    f('message').innerHTML = 'Adding 5 minutes pressed';
    fetch(api + '?command=ADDFIVEMINS&token=' + id).then().catch(function (error) {
        console.log(error)
    });
    visible('pause');
    hide('play');
}

function setToZero() {
    paused = false;
    f('message').innerHTML = 'Restart pressed';
    fetch(api + '?command=SETTOZERO&token=' + id).then().catch(function (error) {
        console.log(error)
    });
    visible('pause');
    hide('play');
}

function playPressed() {
    paused = false;
    f('message').innerHTML = 'Playing pressed';
    hide('play');
    visible('pause');
    fetch(api + '?command=CONTINUE&token=' + id).then().catch(function (error) {
        console.log(error)
    });
}

function pausePressed() {
    paused = true;
    f('message').innerHTML = 'Pause pressed';
    visible('play');
    hide('pause');
    fetch(api + '?command=PAUSED&token=' + id).then().catch(function (error) {
        console.log(error)
    });
}

function setEndTime(timestring) {
    date = new Date();
    endTime = date.getTime() 
    + 60000 * getMinutes(timestring) 
    + 1000 * getSeconds(timestring)
    + 10 * getMilliseconds(timestring);
}

function update() {
    counter++;
    date = new Date();
    var time = endTime - date.getTime();
    if (time < 0) {
        time = 0;
    }
    if(paused == false){
        timeString = getSixDigits(time);
        f('timestring').innerHTML = timeString;
    }
    checkServer();
    window.requestAnimationFrame(update);
}

function getSixDigits(time) {
    return getMinutesTen(time) +
        getMinutesOne(time) +
        ':' +
        getSecondsTen(time) +
        getSecondsOne(time) +
        ':' +
        getMillisecondsTen(time) +
        getMillisecondsOne(time);
}

function getMinutesTen(t) {
    return Math.floor(t / 600000) % 6 + '';
}

function getMinutesOne(t) {
    return Math.floor(t / 60000) % 10 + '';
}

function getSecondsOne(t) {
    return Math.floor(t / 1000) % 10 + '';
}

function getSecondsTen(t) {
    return Math.floor(t / 10000) % 6 + '';
}

function getSeconds(string) {
    return string.substring(3,5) * 1;
}

function getMinutes(string) {
    return string.substring(0,2) * 1;
}

function getMilliseconds(string) {
    return string.substring(6,8) * 1;
}

function getMillisecondsTen(t) {
    return Math.floor(t / 100) % 10 + '';
}

function getMillisecondsOne(t) {
    return Math.floor(t / 10) % 10 + '';
}

function visible(n) {
    f(n).style.display = 'inline-block';
}

function hide(n) {
    f(n).style.display = 'none';
}

function f(n) {
    return document.getElementById(n);
}
