const api = './api.php';
var user = {};

//init();

function init() {
  
  f('loginuser').onsubmit = function (event) {
    event.preventDefault();
    return false;
  }
  
  f('loginuser').onsubmit = login2();
}

function newuser() {
  visible('newuser');
  hide('login');
  hide('loginuser');
}

function login() {
  visible('loginuser');
  hide('login');
  //hide('loginuser');
}

function cancel() {
  visible('loginuser');
  hide('newuser');
  visible('login');
  //hide('loginuser');
}

async function register() {
  var name = f('name').value;
  var email = f('email').value;
  var password = f('password').value;
  try {
    const data = await postData(api, { name: name, email: email, password: password });
    //console.log(JSON.stringify(data)); // JSON-string from `response.json()` call
    if (data.result == 'success') {
      f('name').value = '';
      f('email').value = '';
      f('password').value = '';
      cancel();
    }
  } catch (error) {
    console.error(error);
  }
}

async function postData(url = api, data = {}) {
  // Default options are marked with *
  const response = await fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json'
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: 'follow', // manual, *follow, error
    referrer: 'no-referrer', // no-referrer, *client
    body: JSON.stringify(data) // body data type must match "Content-Type" header
  });
  return await response.json(); // parses JSON response into native JavaScript objects
}

async function login2() {
  var name = f('name2').value;
  var password = f('password2').value;
  try {
    const data = await postData(api, { name: name, password: password });
    //console.log(JSON.stringify(data)); // JSON-string from `response.json()` call
    if (data.result == 'success') {
      f('name2').value = '';
      f('password2').value = '';
      hide('loginuser');
      hide('join');
      user.name = data.name;
      user.token = data.token;
      user.timers = data.timers;
      user.names = data.names;
      f('logged_user').innerHTML = "Welcome " + user.name + " !";
      visible('dashboard');
      list_timers();
    } else {
      visible('invalid_login');
    }
  } catch (error) {

    console.error(error);
  }
}

function list_timers() {
  var node = f('timers');
  var card = f('card_template');
  for (var i = 0; i < user.timers.length; i++) {
    var cln = card.cloneNode(true);
    cln.getElementsByTagName('h2')[0].innerHTML = user.names[i];
    cln.getElementsByTagName('p')[0].innerHTML = '<a href="control.php?id=' + user.timers[i] + '" target="_blank">Open control panel</a>';
    node.appendChild(cln);
    //links += '<li><a href="control.php?id=' + user.timers[i] + '" target="_blank">' + user.names[i] + '</a>';
  }
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