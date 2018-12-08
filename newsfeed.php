<?php 
session_start();
//$_SESSION['user_id']='arjunmahesh97@gmail.com';
//$_SESSION['user_name']='arjun';
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{username}} - Spazzo</title> <!--TODO - title should be dynamic i.e : The username must be displayed-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO : seo stuff goes here - Leave this to me -->
    <meta name="theme-color" content="#8e1b6e">
    <!-- stylesheets and fonts -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/newsfeed.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <script src="js/index.js"></script> -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400">
</head>
<?php
    $pdo = new PDO("mysql:host=localhost;dbname=spazzo", 'root', '');
    
    //$id=$_SESSION['user_id'];
    
    $sql="select * from spazzo.image";
    //var_dump($sql1);
    
    $stmt = $pdo->prepare($sql);
    //$stmt->bindParam(':email', $_SESSION['user_id'], PDO::PARAM_STR);

    $r =$stmt->execute();
    //var_dump($r);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$files=$r;
    $size = sizeof($r);
    //var_dump($r);
    
?>
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
                    <!-- TODO : Redirect to a new form to add new post - leave this to me -->
                    <li><a class="login-btn animated slideInRight" href="new.php"><i class="fas fa-cloud-upload-alt"></i></a></li>
                    <!-- TODO : make the username show up in the navbar on signup or login -->
                    <li><a class="login-btn animated slideInRight" href="userdashboard.php"><img src="" alt=""><?php echo $_SESSION['user_name'];?></a></li>
                    <!-- TODO : Log user out of the session  -->
                    <li><a class="signup-btn animated slideInRight" href="login.php">Logout</a></li>          
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <?php for($i=0;$i<$size;$i++){?>
            <div class="col-md-3 col-xs-12">
                <div class="thumbnail" id="post1">
                    <!-- image and the link to the fullimage goes here -->
                    <div class="imagesize">
                        <a href="fullimage.php?file=<?php echo "images/".$r[$i]['file'];?>"><img src="images/<?php echo $r[$i]['file'];?>" alt="work" class="work" style="height: 100%"></a>
                    </div>
                    <div class="details">
                        <!-- TODO : Add logic to toggle number of views and likes (views can be incremented when a user visits the full image) -->
                        &nbsp; 
                        <span class="icons">
                            <i class="fas fa-eye"></i>
                            <?php echo $r[$i]['views'];?>
                        </span>
                    </div>                            
                </div>
                <p class="author">
                    <img class="author-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTYLrDQ9eHVQH28Tn5cY_grVhGZ_9CP7tJdnqtAcgorxmz97gUK" alt="user">
                    <?php echo $r[$i]['title']; ?>
                </p>
            </div>
            <?php }?>
        </div>
    </div>

    <!-- TODO : ADD FOOTER - leave this to me -->

    <script
     src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script
     src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
     integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
     crossorigin="anonymous" >
    </script>
    <!-- <script src="js/index.js"></script> -->
</body>
</html>