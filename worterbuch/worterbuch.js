var word = document.getElementById('word');
var result = document.getElementById('result');
var newword = document.getElementById('newword');
var token = document.getElementById('token');
var id = document.getElementById('word_id');

var token_url = "";
if(token){
  token_url = "&token=" + token.value;
}

var id_url = "";
if(id){
  id_url = "&id="+id.value;
}


word.addEventListener('input', typing);

function typing(){
  if(word.value.length>0){
    fetch('header.php?getwords='+word.value)
      .then(response => response.json())
      .then(data => {
        let t="";
        for(let i=0;i<data.result.length;i++){
          if(word.value == data.result[i].word.substr(0,word.value.length)){
            t += "<div><a href=\"word.php?action=showword&id=" + data.result[i].id + token_url + "\" >" + data.result[i].word + "</a>&nbsp;<img src=\"flags/"+data.result[i].lang+".png\"></div>";
            //t += "<div onclick=\"redirect('word.php?action=showword&id=" + data.result[i].id + token_url + "')\" >" + data.result[i].word + "&nbsp;<img src=\"flags/"+data.result[i].lang+".png\"></div>";
          }
        }
        result.innerHTML = t;
        if(newword){
          newword.value = word.value;
        }
      });
  }else{
    result.innerHTML = "";
  }
}

function searching_pair(){
  if(word.value.length>0){
    fetch('header.php?getwords='+word.value)
      .then(response => response.json())
      .then(data => {
        let t="";
        for(let i=0;i<data.result.length;i++){
          if(word.value == data.result[i].word.substr(0,word.value.length)){
            t += "<div><a href=\"editword.php?action=addpair&id2=" + data.result[i].id + token_url + id_url + "\" >" + data.result[i].word + "</a>&nbsp;<img src=\"flags/"+data.result[i].lang+".png\"></div>";
          }
        }
        result.innerHTML = t;
        if(newword){
          newword.value = word.value;
        }
      });
  }else{
    result.innerHTML = "";
  }
}

function redirect(link){
  window.location.replace ('./' + link);
}


