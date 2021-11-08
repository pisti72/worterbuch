var i=1;

//show("projects");

function loginShow(){
  hideAll()
  show("login");
  console.log("Login pressed")
}

function showProject(n){
  hideAll()
  show("notes");
}

function register(){
  show("token");
}

function signupShow(){
  hideAll()
  show("sign-up");
}

function loginButton(){
  hideAll()
  show("projects");
}

function hideAll(){
  hide("login");
  hide("sign-up");
  hide("projects");
  hide("token");
}


function show(n){
  document.getElementById(n).style.display = "block";
}

function hide(n){
  document.getElementById(n).style.display = "none";
}
