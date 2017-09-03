inic();

var user;
var token;
var texts;
var languages;

//---------------------
// functions
//---------------------

function inic(){
    hideAll();
    setupLanguage();
    addEvents();
    updateStat();
}

function addEvents(){
    $("#btn_login").click(function(){
        var email = $('#login_email').val();
        var password = $('#login_password').val();
        $.getJSON({
            url:'webservice.php',
            data:{'action':16,'email':email,'password':password}}
        ).done(function(result){
            if(result.name != null && result.token != null){
                user = result;
                token = result.token;
                doLogin();
            }
        });
    });
    
    $("#btn_logout").click(function(){
        token = "";
        $("#signedin").hide();
        $("#user_name").html('');
        $("#btn_isnew").hide();
        $('#login').show();
        $('#jumbotron').show();
        $('#footer').show();
        $('#devices').show();
        $('#charts').show();
        updateStat();
    });
    
    $("#btn_register").click(function(){
        $('#jumbotron').hide();
        $('#form_search').hide();
        $('#form_register').show();
        $('#reg_name').val('');
        $('#reg_email').val('');
        $('#reg_password').val('');
    });
    
    $("#btn_register_submit").click(function(){
        var name = $('#reg_name').val();
        var email = $('#reg_email').val();
        var password = $('#reg_password').val();
        $.getJSON({
            url:'webservice.php',
            data:{'action':17,'name':name,'email':email,'password':password}
        })
        .done(function(result){
            if(result.name != null && result.token != null){
                user = result;
                token = user.token;
                doLogin();
            }
        });
    });
    
    $("#btn_register_cancel").click(function(){
        $('#jumbotron').show();
        $('#form_search').show();
        $('#form_register').hide();
        $('#reg_name').val('');
        $('#reg_email').val('');
        $('#reg_password').val('');
    });
    
    $("#btn_isnew").click(function(){
        $('#form_search').hide();
        $('#new_word').val($('#search').val());
        $('#results').hide();
        $('#selectedword').hide();
        $('#form_newword').show();
    });
    
    $("#btn_newword_submit").click(function(){
        insertWord();
        $('#form_newword').hide();
        $('#form_search').show();
        $('#results').show();
        $('#selectedword').show();
        $('#search').val('');
        $('#new_word').val('');
        $('#new_example').val('');
        $('#new_language').val('');
        $('#new_language_icon').html('');
    });
    
    $("#btn_newword_cancel").click(function(){
        $('#form_newword').hide();
        $('#form_search').show();
        $('#results').show();
        $('#selectedword').show();
        $('#results').html('');
        $('#selectedword').html('');
        $('#search').val('');
        $('#new_word').val('');
        $('#new_example').val('');
        $('#new_language').val('');
        $('#new_language_icon').html('');
    });
    
    $('#search').keyup(function(){searchforword();});
    
    $('#new_language').keyup(function(){
        var name = $('#new_language').val().toLowerCase();
        var result=[];
        
        for(var i=0;i<languages.length;i++){
            if(name.length >= 1 && languages[i].name.toLowerCase().search(name) != -1){
                result.push(languages[i]);
            }
        }
        
        if(result.length == 1){
            language = result[0];
            $('#new_language').val(language.name);
            var a = '<img src="img/flags/' + language.id + '.png">';
            $('#new_language_icon').html(a);
        }else{
            $('#new_language_icon').html('');
        }
    });
}

function searchforword(){
    var word = $('#search').val();
    $('#results').html('');//if any changes
    $('#selectedword').html('');
    if(word.length>1){
        $.getJSON({
            url:'webservice.php',
            data:{'action':5,'word':word}}
        ).done(function(result){
            if(result.length>0){
                $('#results').html('');//prevent to be twice
                var id=0;
                $.each(result, function(i, field){
                    var a = '<div>';
                    
                    if(typeof user != "undefined" && field.readonly != '1'){
                        a += '<span onclick="editword(' + field.id + ')" style="cursor:pointer" class="glyphicon glyphicon-pencil"></span>&nbsp;';
                    }
                    a += '<img src="img/flags/' + field.language_id+'.png">&nbsp;<span onclick="showwords(';
                    a += field.id + ')" style="cursor:pointer;font-weight:bold">';
                    a += field.word + '</span>';
                    a += '<span style="font-style:italic;font-size:14px;"> - ' + field.example + '</span>';
                    a += '<span id="resultsin' + field.id + '"></span></div>';
                    $('#results').append(a);
                    id = field.id;
                });
                if(result.length == 1){
                    showwords(id);
                }else{
                    $('#selectedword').html('');
                }
            }
        });
    }
}

function showwords(id){
    $.getJSON({
            url:'webservice.php',
            data:{'action':11,'id':id,'token':token}}
        ).done(function(result){
            $('#selectedword').html('');
            $.each(result.data, function(id, field){
                var a = '<div><img src="img/flags/';
                a += field.language_id+'.png">&nbsp;<span style="font-weight:bold;cursor:pointer;" onclick="searchword(\'' + field.word + '\')">';
                a += field.word + '</span>';
                a += '<span style="font-style:italic;font-size:14px;"> - ' + field.example + '</span>';//example sentence
                a += '</div>';//terminal
                
                $('#selectedword').append(a);
            });
            if(result.visited) {
                a = '&nbsp;<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;' + result['visited'];//eye
                $('#resultsin'+id).html(a);
            }
        });
}

function searchword(word){
    $("#search").val(word);
    searchforword();
}

function getVisitedWordsByUser(){
    
}

function editword(id){
    $('#form_search').hide();
    $('#results').hide();
    $('#selectedword').hide();
    $('#form_editword').show();
    
    $("#btn_editword_submit").click(function(){
        var word = $('#edit_word').val();
        var example = $('#edit_example').val();
        $.ajax({
            url:"webservice.php",
            data:{"action":8, "token":token, "word":word, "example":example, "id":id}
        }).done(function() {
            goBackToSearching();
        });
        
    });
    
    $("#btn_editword_delete").click(function(){
        $.ajax({
            url:"webservice.php",
            data:{"action":10,"token":token,"id":id}
        }).done(function() {
            goBackToSearching();
        });
        
    });
    
    $("#btn_editword_cancel").click(function(){
        goBackToSearching();
    });
    
    $("#btn_editword_lock").click(function(){
        $.ajax({
            url:"webservice.php",
            data:{"action":15,"token":token,"id":id}
        }).done(function() {
            goBackToSearching();
        });
    });
    
    
    
    $.getJSON({
        url:'webservice.php',
        data:{"action":9,"id":id}})
    .done(function(result){
        $('#edit_word').val(result.word);
        $('#edit_example').val(result.example);
    });
    
    drawPaired(id);
    
    $('#pair_word').keyup(function(){
        var word = $('#pair_word').val();
        $('#pair_results').html('');
        if(word.length>1){
            $.getJSON({
                url:'webservice.php',
                data:{'action':5,'word':word}}
            ).done(function(result){
                $('#pair_results').html('');
                if(result.length>0){
                    $.each(result, function(i, field){
                        var a = '<div><span  onclick="pairword(' + id + ',' + field.id + ')" style="cursor:pointer" class="glyphicon glyphicon-link">';
                        a += '</span>&nbsp<img src="img/flags/' + field.language_id+'.png">&nbsp;';
                        a += '<b>' + field.word + '</b>';
                        a += '<span style="font-style:italic;font-size:14px;"> - ' + field.example + '</span></div>';
                        $('#pair_results').append(a);
                    });
                }
            });
        }
    });
}

function goBackToSearching(){
    $('#form_editword').hide();
    $('#edit_word').val('');
    $('#edit_example').val('');
    $('#pair_word').val('');
    
    $('#form_search').show();
    $('#results').show();
    $('#selectedword').show();
    $('#results').html('');
    $('#selectedword').html('');
    $('#pair_results').html('');
    
    $("#btn_editword_submit").unbind();
    $("#btn_editword_delete").unbind();
    $("#btn_editword_cancel").unbind();
    $("#btn_editword_lock").unbind();
    $("#pair_word").unbind();
}

function doLogin(){
    $("#signedin").show();
    $("#user_name").html(user.name);
    $("#btn_isnew").show();
    $('#login').hide();
    $('#jumbotron').hide();
    $('#footer').hide();
    $('#devices').hide();
    $('#charts').hide();
}

function doLogout(){
    //TODO
}

function pairword(id,id2){
    $.ajax({
        url:"webservice.php",
        data:{"action":13,"token":token,"word1_id":id,"word2_id":id2}
    }).done(function() {
        drawPaired(id);
    });
    
}

function unpairword(id){
    $.ajax({
        url:"webservice.php",
        data:{"action":12,"token":token,"id":id}
    }).done(function() {
        drawPaired(id);//bug
    });
}

function drawPaired(id){
    $('#paired').html('');
    $.getJSON({
        url:'webservice.php',
        data:{'action':11,'id':id,'token':token}}
    ).done(function(result){
        if(result.data.length>0){
            $('#paired').html('');
            $.each(result.data, function(i, field){
                var a = '<div><span  onclick="unpairword(' + field.pair_id + ')" style="cursor:pointer" class="glyphicon glyphicon-remove"></span>&nbsp;';
                a += '<img src="img/flags/' + field.language_id+'.png">&nbsp;';
                a += '<b>' + field.word + '</b>';
                a += '<span style="font-style:italic;font-size:14px;"> - ' + field.example + '</span></div>';
                $('#paired').append(a);
            });
        }else{
            $('#paired').html('Not paired yet.');
        }
    });
}

function insertWord() {
    var word = $('#new_word').val();
    var example = $('#new_example').val();
    $.ajax({
        url:"webservice.php",
        data:{"action":3,"token":token,"word":word,"example":example,"language_id":language.id}})
    .fail(function() {
        alert('oppps');
    })
    .done(function(result){
        
    });
}

function hideAll() {
    //$('#results').hide();
    $('#signedin').hide();
    $('#btn_isnew').hide();
    $('#form_register').hide();
    $('#form_newword').hide();
    $('#form_editword').hide();
}

function getUserCount() {
    $.ajax({
        url:"webservice.php",
        data:{"action":"1"}})
    .fail(function() {
        alert('oppps');
    })
    .done(function(result){
        $("#user_count").html(result);
    });
}

function setupLanguage(){
    $.getJSON({
        url:"webservice.php",
        data:{"action":14}})
    .fail(function() {
        alert('No translations');
    })
    .done(function(texts){
        $('#jumbotron_title').html(texts.jumbotron_title);
        $('#jumbotron_call').html(texts.jumbotron_call.replace('%%',texts.users));
        $('#btn_login').html(texts.btn_login);
        $('#btn_register').html(texts.btn_reg);
        $('#search').attr('placeholder',texts.search);
        $('#registration').html(texts.registration);
        $('#reg_name_label').html(texts.reg_name_label);
        $('#reg_name').attr('placeholder',texts.reg_name);
        $('#reg_email_label').html(texts.reg_email_label);
        $('#reg_email').attr('placeholder',texts.reg_email);
        $('#reg_password_label').html(texts.reg_password_label);
        $('#reg_password').attr('placeholder',texts.reg_password);
        $('#btn_register_submit').html(texts.btn_register_submit);
        $('#btn_register_cancel').html(texts.btn_register_cancel);
        $('#btn_isnew').html(texts.btn_isnew);
        //$('#inputCurrency').attr('placeholder',texts.reg_currency);
        //$('#inputBalance').attr('placeholder',texts.reg_balance);
        //$('#btn_reg2').html(texts.btn_reg2);
        //$('#btn_reg2_cancel').html(texts.btn_reg2_cancel);
        //var a = '<option value="0">--- Please select ---</option>';
        //console.log(texts);
        setLanguages(texts.language);
        //for(var i=0;i<categories.length;i++) {
        //    a += '<option value="' + categories[i].id + '">' + categories[i].name + '</option>';
        //}
        //$('#inputCategory').html(a);
    });
}

function setLanguages(i){
    languages = i;
}

function updateStat(){
    $.getJSON({
        url:"webservice.php",
        data:{"action":18}})
    .fail(function() {
        alert('No statistic');
    })
    .done(function(result){
        var labels=[];
        var data=[];
        for(var i=0;i<result.length;i++){
            console.log("result "+i+"/"+result.length);
            var k=parseInt(result[i].id)-1;
            labels.push(languages[k].name);
            data.push(result[i].words);
        }
        drawLangCountBar(labels,data);
    });
}

function drawLangCountBar(labels,data){
    var a='<canvas id="chartLangCanvas" width="400" height="200"></canvas>';
    $('#chartLangCount').html(a);
    var ctx = $("#chartLangCanvas");
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Number of words by language',
            data: data,
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 1,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)"
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    });
}
    