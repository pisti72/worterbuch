const STATE_HALT = 0;
const api = './api.php';
const tickNormal = 48;
const tickIdle = 500;
const idleGoToSleep = 1000;
var state = STATE_HALT;
var endTime = 0;
var counter = 0;
var timeString = '';
var date = {};
var idle = 0;
var tick = tickNormal;
var paused = false;
var pausedAt = 0;

getStyle();
window.requestAnimationFrame(update);

function checkServer() {
    if (counter % tick == 0) {
        fetch(api + '?timer=' + id).then(function (response) {
            return response.json()
        }).then(function (json) {
            if (json.command == 'SETONEHOUR') {
                setOneHour();
                paused = false;
            } else if (json.command == 'DECFIVEMINS') {
                decFiveMins();
                paused = false;
            } else if (json.command == 'ADDFIVEMINS') {
                addFiveMins();
                paused = false;
            } else if (json.command == 'SETTOZERO') {
                setToZero();
                paused = false;
            } else if (json.command == 'PAUSED') {
                paused = true;
                date = new Date();
                pausedAt = endTime - date.getTime();
            } else if (json.command == 'CONTINUE') {
                paused = false;
            }
            //send back the timeString
            fetch(api + '?timestring=' + timeString
                + '&receivedcommand=' + json.command
                + '&token=' + id).then(function (response) {
                    return response.json()
                })
                .then(function (json) {
                    if (json.result == 'success') {
                        hide('connection');
                    } else {
                        visible('connection');
                    }
                })
                .catch(function (error) {
                    visible('connection');
                })
        }).catch(function (error) {
            visible('connection');
        })
    }
}

function setOneMinutes() {
    setEndTime(60);
}

function setOneHour() {
    setEndTime(60 * 60);
}

function setToZero() {
    setEndTime(0);
}

function decFiveMins() {
    addMinutesToEndTime(-5);
}

function addFiveMins() {
    addMinutesToEndTime(5);
}

function setEndTime(n) {
    date = new Date();
    endTime = date.getTime() + 1000 * n;
}

function addSecondsToEndTime(n) {
    endTime += 1000 * n;
}

function addMinutesToEndTime(n) {
    endTime += 60000 * n;
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

function getSeconds(t) {
    return Math.floor(t / 1000) % 100 + '';
}

function getMillisecondsTen(t) {
    return Math.floor(t / 100) % 10 + '';
}

function getMillisecondsOne(t) {
    return Math.floor(t / 10) % 10 + '';
}

function update() {
    counter++;
    date = new Date();
    if (paused) {
        endTime = pausedAt + date.getTime();
    }
    var time = endTime - date.getTime();
    if (time < 0) {
        time = 0;
        idle++;
        if (idle > idleGoToSleep) {
            tick = tickIdle;
        }
    } else {
        idle = 0;
        tick = tickNormal;
    }
    checkServer();
    timeString = getSixDigits(time);
    setDigits(time);
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

function setDigits(time) {
    f('d1').innerHTML = getMinutesTen(time);
    f('d2').innerHTML = getMinutesOne(time);
    f('d3').innerHTML = getSecondsTen(time);
    f('d4').innerHTML = getSecondsOne(time);
    f('d5').innerHTML = getMillisecondsTen(time);
    f('d6').innerHTML = getMillisecondsOne(time);
}

function getStyle() {
    fetch(api + '?timer=' + id).then(function (response) {
        return response.json()
    }).then(function (json) {
        visible('digit_container');
        var style = json.style;
        var elem = style.split(';');
        f('bg_alice').style.backgroundImage = 'url(assets/backgrounds/' + elem[0] + ')';
        f('container_digits').style.top = elem[1];
        f('container_digits').style.left = elem[2];
        f('container_digits').style.width = elem[3];
        f('container_digits').style.backgroundColor = elem[4];
        f('container_digits').style.fontFamily = elem[5];
        f('container_digits').style.fontSize = elem[6];
        f('container_digits').style.color = elem[7];
        var array = document.getElementsByClassName('digit');
        for (var i = 0; i < array.length; i++) {
            array[i].style.width = elem[8];
        }

    });
}

function visible(n) {
    f(n).style.display = 'block';
}

function hide(n) {
    f(n).style.display = 'none';
}

function f(n) {
    return document.getElementById(n);
}
