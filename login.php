<?php 
session_start();
$_SESSION['user_id'] = 'abc@xyz';
$_SESSION['user_name']='arjun';
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spazzo | Login</title>
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
//echo "Connected successfully to mysql";
$sql = "SELECT * FROM spazzo.users";
$result = $conn->query($sql);
//var_dump($result);
if($result == false) {
    die("Query failed");
}

$conn->close();
//die("Testing ended");
// define variables and set to empty values
//$name = $email = $gender = $comment = $website = "";
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    #$name = test_input($_POST["name"]);
    #$email = test_input($_POST["email"]);
    #$website = test_input($_POST["website"]);
    #$comment = test_input($_POST["comment"]);
    #$gender = test_input($_POST["gender"]);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} */
//var_dump($_REQUEST);
//var_dump(isset($_REQUEST['uname']));
if(!isset($_REQUEST['email'])) {
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
                    <li><a class="login-btn animated slideInRight" href="#">Login</a></li>
                    <li><a class="signup-btn animated slideInRight" href="signup.php">Signup</a></li>           
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <h1 class="welcome">Welcome Back !</h1>
                <!-- TODO : Change content - leave this to me -->
                <p>Spazzo is an invite-only platform that lets designers create content, and share it with other designers 
                    and potential recruiters! <br> Go ahead, give Spazzo a try. <i class="fas fa-grin-wink"></i></p>
                    <!-- TODO : Verify user auth and create a session and redirect to newsfeed.html -->
                    <form class="form" action="" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="mikewazowski@gmail.com" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="********" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Let me in!"> <a class="member" href="signup.php">New here? click here!</a>
                    </div>                    
                </form>
            </div>
            <div class="col-lg-6 col-sm-12">
                <img class="signup-img" src="assets/login.svg" alt="login" />
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
        $sql = 'select validateUser(:email,:password)';
        $stmt = $pdo->prepare($sql);
        //var_dump($_REQUEST['email']);
        //var_dump($_REQUEST['password']);
        $stmt->bindParam(':email', $_REQUEST['email'], PDO::PARAM_STR);        
        $stmt->bindParam(':password', $_REQUEST['password'], PDO::PARAM_STR);
        $r =$stmt->execute();
        //var_dump($stmt);
        $r = $stmt->fetch(PDO::FETCH_NUM);
        //var_dump($r);
        
        $stmt->closeCursor();
        //echo "<script>alert('Invalid User name or password, please retry');document.location='first.php'</script>";
        $uid = $r[0];
        //var_dump($uid);
        
       if($uid) {
            $username = $uid;
            //var_dump($username);
            $_SESSION['user_id'] = $_REQUEST['email'];
            $_SESSION['user_name'] = $username;
            //var_dump($_SESSION['user_name']);
            //echo "<script>alert('Invalid User name or password, please retry');document.location='first.php'</script>";
            //$_SESSION['user_name'] = $_REQUEST['uname'];
            echo "<script>document.location='userdashboard.php'</script>";
        } else {
            $_SESSION['user_id'] = 'Unknown';
            $_SESSION['user_name'] = 'Unknown';
            unset($_REQUEST['email']);
            echo "<script>alert('Invalid User name or password, please retry');document.location='login.php'</script>";
            
        }
        //printf("%s\n",$uid);
        //var_dump($uid);
        // execute the second query to get values from OUT parameter
        //var_dump($r);
    } catch (PDOException $pe) {
        die("Error occurred:" . $pe->getMessage());
    }
}
 ?>        
     
      
 </div>
 	
</html>  