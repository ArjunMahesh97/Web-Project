<?php 
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spazzo | signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO : seo stuff goes here -->
    <meta name="theme-color" content="#8e1b6e">
    <!-- stylesheets and fonts -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/getin.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <script src="js/index.js"></script> -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400">
</head>
<?php 
if(!isset($_REQUEST['name'])) {
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
                <a class="navbar-brand animated fadeIn" href="first.php">Spazzo</a>
            </div>
                
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="login-btn animated slideInRight" href="login.php">Login</a></li>
                    <li><a class="signup-btn animated slideInRight" href="#">Signup</a></li>           
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <h1>Join Spazzo</h1>
                <p>Spazzo is an invite-only platform that lets designers create content, and share it with other designers 
                    and potential recruiters! <br> Go ahead, give Spazzo a try. <i class="fas fa-grin-wink"></i></p>
                <!-- TODO : Write logic to add all the form details to the database and make sure to add md5 password enc 
                and redirect user to newsfeed.html -->
                <form class="form">
                    <div class="form-group">
                        <label for="name">Full name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Mike Wazowski" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="mikewazowski@gmail.com" required/>
                    </div>
                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <input class="form-control" id="profession" name="profession" type="text" placeholder="UX Designer" required/>
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <input class="form-control" id="skills" name="skills" type="text" placeholder="UI Design,UX Design,Web Design" required/>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input class="form-control" id="city" name="city" type="text" placeholder="Florida,USA" required/>
                    </div>
                    <div class="form-group">
                        <label for="web">Website</label>
                        <input class="form-control" id="web" name="web" type="url" placeholder="https://mikewazowski.com"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="********" required/>
                    </div>
                    <div class="form-group">
                        <label for="invite">Invite Code</label>
                        <input class="form-control" id="invite" name="input" type="password" placeholder="69069" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Let me in!"> 
                        <a class="member" href="login.php">Already a member? click here!</a>
                    </div>                    
                </form>
            </div>
            <div class="col-lg-6 col-sm-12">
                <img class="signup-img" src="assets/signup.svg" alt="signup" />
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
 <?php
} else {
    try {
        
        $pdo = new PDO("mysql:host=localhost;dbname=spazzo", 'root', '');
        
        // execute the stored procedure
        
        $sql2='select invite_code from spazzo.users';
        $stmt2=$pdo->prepare($sql2);
        //var_dump($stmt2);
        $r2 = $stmt2->execute();
        $r2 = $stmt2->fetchAll(PDO::FETCH_NUM);
        //var_dump($r2);
        //var_dump($r2[0][0]);
        for($i=0 ; $i<sizeof($r2); $i++){
            if($_REQUEST['input']==$r2[$i][0]){
                break;
            }
            elseif ($i== (sizeof($r2)-1)) {
                echo "<script>alert('Invalid Invite Code');window.location='signup.php'</script>"; 
                exit(0);
            }
        }
        
        
        $code=rand(10000,99999);
        
        
        
        $sql = 'select insertUser(:email,:name,:pwd,:invite,:place,:prof,:web)';
        $stmt = $pdo->prepare($sql);
        //var_dump($_REQUEST['name']);
        //var_dump($_REQUEST['email']);
        //var_dump($_REQUEST['password']);
        //var_dump($_REQUEST['input']);
        //var_dump($_REQUEST['city']);
        //var_dump($_REQUEST['profession']);
        //var_dump($_REQUEST['web']);
    
        $stmt->bindParam(':email', $_REQUEST['email'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $_REQUEST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':pwd', $_REQUEST['password'], PDO::PARAM_STR);
        $stmt->bindParam(':invite', $code, PDO::PARAM_STR);
        $stmt->bindParam(':place', $_REQUEST['city'], PDO::PARAM_STR);
        $stmt->bindParam(':prof', $_REQUEST['profession'], PDO::PARAM_STR);
        $stmt->bindParam(':web', $_REQUEST['web'], PDO::PARAM_STR);
        $r =$stmt->execute();
        //var_dump($stmt);
        //var_dump($r);
        $r = $stmt->fetch(PDO::FETCH_NUM);
        //var_dump($r);
        $stmt->closeCursor();
        $uid=$r[0];
        // execute the second query to get values from OUT parameter
        if($uid) {
             // call next screen
             $_SESSION['user_id'] = $_REQUEST['email'];
             $_SESSION['user_name'] = $_REQUEST['name'];
             echo "<script>alert('Welcome " . $_SESSION['user_name'] . "');document.location='userdashboard.php'</script>";
        } else {
            printf("Failed creating user");
            $_SESSION['user_id'] = '0';
            $_SESSION['user_name'] = '0';
            unset($_REQUEST['name']);
            echo "<script>alert('Failed creating user, please try diferent user name or email');document.location='signup.php'</script>";
        }
        //var_dump($_SESSION);
    } catch (PDOException $pe) {
        die("Error occurred:" . $pe->getMessage());
    }
}
?>     
 	
</html>