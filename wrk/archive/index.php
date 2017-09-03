<?php
require ('guard.php');
/*
https://my.freenom.com/clientarea.php
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="dictionary, vocabulary">
    <meta name="description" content="Dictionary which track your learning progress.">
    <meta name="author" content="Istvan Szalontai">
    <meta name="google-site-verification" content="-JxU4_KnP-VitZbgBnZUTU5XMQRE3J3QUT6ld6y3aJk" />
    <link rel="icon" href="img/favicon.ico">
    <title>Communitydictionary - Dictionary English German Hungarian</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script>var token = '<?php echo $token; ?>';</script>
  </head>

  <body>

    <nav class="navbar navbar-inverse" style="background-color:#0000a0;border-radius:0px;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="color:white;">CommunityDictionary.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" method="post" id="login">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success" id="btn_login"></button>
          </form>
          <div class="navbar-form navbar-right" style="color:#ffffff;" id="signedin"></div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="container" >
        <div class="jumbotron" id="jumbotron" style="background-image: url(img/jumbotron1.jpg);color:black;">
            <h1 id="jumbotron_title"></h1>
            <p id="jumbotron_call"></p>
            <p><button class="btn btn-primary btn-lg" id="btn_register">Register for FREE &raquo;</button></p>
        </div>
    </div>
    
    <!-- Search engine -->
    <div class="container" >
        <div class="form-horizontal" id="form_search">
            <div class="form-group">
                <div class="col-xs-8 col-md-11">
                    <input type="text" class="form-control input-lg" id="search" placeholder="Type a word here"/>
                </div>
                <div class="col-xs-4 col-md-1">
                    <button class="btn btn-primary btn-lg" id="btn_isnew">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>        
            
            
    <!-- New word -->
    <div class="container" >
        <div class="form-horizontal" id="form_newword">
            <div class="form-group">
                <label class="control-label col-xs-2">New word</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" id="new_word" placeholder="Type the new word here"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Example</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" id="new_example" placeholder="Example sentence with this word"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2">Language</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-lg" id="new_language" placeholder="Language"/>
                </div>
                <div class="col-xs-8" id="new_language_icon"></div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_newword_submit">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        Submit
                    </button>
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_newword_cancel">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        Back
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit word -->
    <div class="container" id="form_editword">
        <h1>Edit word</h1>
        <p>You can change the words here below.</p>
        <div class="form-horizontal"  >
            <div class="form-group">
                <label class="control-label col-xs-2">Word</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" id="edit_word"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2">Example</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" id="edit_example"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_editword_submit">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        Submit
                    </button>
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_editword_delete">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        Delete
                    </button>
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_editword_lock">
                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                        Lock
                    </button>
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_editword_cancel">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        Back
                    </button>
                </div>
            </div>
        </div>
        <h2>Paired with</h2>
        <div id="paired" style="height:250px;overflow:auto;"></div>
        <h2>New pairs</h2>
        <div class="form-horizontal"  >
            <div class="form-group">
                <label class="control-label col-xs-2">Word</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" id="pair_word"/>
                </div>
            </div>
        </div>
        <div id="pair_results" style="height:250px;overflow:auto;"></div>
    </div>
    
    <!-- Register -->
    <div class="container" >
        <form class="form-horizontal" id="form_register" method="post">
            <h1>Registration form</h1>
            <div class="form-group">
                <label class="control-label col-xs-2">Name</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" name="reg_name" placeholder="Your name"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2">Email</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control input-lg" name="reg_email" placeholder="Your email"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2">Password</label>
                <div class="col-xs-10">
                    <input type="password" class="form-control input-lg" name="reg_password" placeholder="Your password"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg" type="submit" id="btn_register_submit">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Result words -->
    <div class="container" >
        <div class="row">
            <div class="col-xs-6" id="results" style="height:500px;overflow:auto;"></div>
            <div class="col-xs-6" id="selectedword" style="height:500px;overflow:auto;border-left: 1px solid grey"></div>
        </div>
    </div>
    
    <!-- Devices -->
    <div class="container" id="devices">
        <p class="text-center" ><img src="img/responsive.png" class="img-responsive" alt="It is responsive!"/></p>
    </div>

    <!-- foooter -->
    <footer style="background-color:#0000a0;border-radius:0px;">
        <div class="container" >
            <div class="row">    
                <div class="col-xs-6 col-md-4 column">          
                    <h4 style="color:white;">Information</h4>
                    <ul class="nav">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                    </ul> 
                </div>
                <div class="col-xs-6 col-md-4 column">          
                    <h4 style="color:white;">Follow Us</h4>
                    <ul class="nav">
                        <li><a href="#">Facebook</a></li>
                    </ul> 
                </div>
                <div class="col-xs-6 col-md-4 column">          
                    <h4 style="color:white;">Contact Us</h4>
                    <ul class="nav">
                        <li><a href="mailto:istvan.szalontai12@gmail.com?subject=CommDict">Email</a></li>
                    </ul> 
                </div>
            </div>
            <p style="color:white;">&copy; Copyright 2016, Istv&aacute;n Szalontai</p>
        </div>  
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
