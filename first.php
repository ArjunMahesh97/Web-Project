<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spazzo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO : seo stuff goes here -->
    <meta name="theme-color" content="#efe3dd">
    <!-- stylesheets and fonts -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <script src="js/index.js"></script> -->
    <!-- TODO : Create favivons for all pages -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>                
                <a class="navbar-brand animated fadeIn" href="#">Spazzo</a>
            </div>
                
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="login-btn animated slideInRight" href="about.php">ABOUT US</a></li>
                    <li><a class="login-btn animated slideInRight" href="login.php">LOGIN</a></li>
                    <li><a class="signup-btn animated slideInRight" href="signup.php">SIGNUP</a></li>           
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-push-6">
                    <img src="assets/hero.png" alt="Designer" class="img-hero animated fadeIn" />
                </div>
                <div class="col-lg-6 col-lg-pull-6 about">
                    <h1 class="tagline animated fadeIn">Digital art meets Designers</h1>
                    <p class="desc animated fadeIn">Looking for a design portal that isn't crowded with posts and designers
                        that you don't care about? While being respectful to a fellow designer's work is important, 
                        there simply comes a time when you think, "Okay, I've had enough of this spammy posts in my design 
                        feed, I need some good content to grow as a designer".
                        <br> Fret not, Spazzo is the social design portal that helps you do exactly just that.
                    </p>
                    <a href="login.php" class="start-btn animated fadeIn">Get started</a>
                </div>
            </div>
        </div>
    </div>
    
    <script
     src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script
     src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
     integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
     crossorigin="anonymous" >
    </script>
</body>
</html>