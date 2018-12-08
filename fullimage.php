<?php
session_start();
//var_dump($_GET['file']);
?>
<?php

    $pdo = new PDO("mysql:host=localhost;dbname=spazzo", 'root', '');
    
    //$id=$_SESSION['user_id'];
    
    $sql="select * from spazzo.image where file=:file";
    
    //var_dump($sql1);
    $string=substr($_GET['file'],7);
    //var_dump($string);
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':file', $string, PDO::PARAM_STR);
    //var_dump($stmt);
    $r =$stmt->execute();
    //var_dump($r);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$files=$r;
    $size = sizeof($r);
    //var_dump($r);
    $desc=$r[0]['description'];
    $title=$r[0]['title'];
    $author=$r[0]['uid'];
    $views=$r[0]['views'];
    
    
    $sql2="select fullname from spazzo.users where uid=:author";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':author', $author, PDO::PARAM_STR);
    //var_dump($stmt2);
    $r2 =$stmt2->execute();
    //var_dump($r);
    $r2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($r2);
    $name=$r2[0]['fullname'];
?>
<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
        // Create connection
    $conn = new mysqli($servername, $username, $password);
        //var_dump($conn);
        // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql="update spazzo.image set views=views+1 where file='".$string."'";
    //$sql2="select fullname from spazzo.users where uid='".$author."'";
    //var_dump($sql2);
    
    $result = $conn->query($sql);
    //$result2=$conn->query($sql2);
    //var_dump($result2);
    if($result == false) {
        die("Query failed");
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{image title}} - Spazzo</title> <!--TODO - title should be dynamic i.e : The image title must be displayed-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO : seo stuff goes here - Leave this to me -->
    <meta name="theme-color" content="#8e1b6e">
    <!-- stylesheets and fonts -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/fullimage.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <script src="js/index.js"></script> -->
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
                <a class="navbar-brand animated fadeIn" href="newsfeed.php">Spazzo</a>
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
            <div class="col-md-9 col-xs-12">
                <div class="thumbnail">
                    <img src="<?php echo $_GET['file'];?>" alt="image name" class="post-img">
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <h2 class="post-title">
                    <?php echo $desc; ?>
                </h2>
                <span>
                    by 
                    <a class="author" ><?php echo $name; ?></a>
                </span>
                <div class="description">
                    <p>
                        <?php echo $title; ?>
                    </p>
                </div>
                <!-- TODO : Like and views -->

                <div class="reactions">
                    <span>
                        <i class="fa fa-eye"></i>
                        <?php echo $views; ?>
                    </span> 
                    &nbsp;
                </div>
                
                
            </div>
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