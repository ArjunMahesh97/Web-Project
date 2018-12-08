<?php 
session_start();
//$_SESSION['user_id'] = 'arjunmahesh97@gmail.com';
//$_SESSION['user_name']='arjun';
?>
<?php
    if(!isset($_POST['upload'])){   
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Post - Spazzo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO : seo stuff goes here - Leave this to me -->
    <meta name="theme-color" content="#8e1b6e">
    <!-- stylesheets and fonts -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/newpost.css" />
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
                    <li><a class="login-btn animated slideInRight" href="#"><i class="fas fa-cloud-upload-alt"></i></a></li>
                    <!-- TODO : make the username show up in the navbar on signup or login -->
                    <li><a class="login-btn animated slideInRight" href="userdashboard.php"><img src="" alt=""><?php echo $_SESSION['user_name'];?></a></li>
                    <!-- TODO : Log user out of the session  -->
                    <li><a class="signup-btn animated slideInRight" href="signup.php">Logout</a></li>           
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <h1 class="welcome">Post your work here</h1>
                
                <!-- TODO : Add image, title and it's description to the database and redirect to newsfeed.html  -->
                <form class="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="upload" for="image">Upload your shot</label>
                        <input class="form-control" id="image" name="image" type="file" placeholder="Drag and drop your work here" required/>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" name="title" type="text" placeholder="Name your work.." required/>
                    </div>
                    <div class="form-group">
                        <label for="description">Describe your work</label>
                        <textarea class="form-control" id="description" name="text" type="text" placeholder="Describe your work.." required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="upload" value="Upload">
                    </div>                    
                </form>
            </div>
            <div class="col-lg-6 col-sm-12">
                <img class="signup-img" src="assets/upload.svg" alt="upload" />
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
<?php
}else{
    $target="images/".basename($_FILES['image']['name']);
        
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
        
    $image=$_FILES['image']['name'];
    //var_dump($image);
    $text=$_POST['text'];
    //var_dump($text);
    $title=$_POST['title'];
    //var_dump($title);
    $id=$_SESSION['user_id'];
        
    $sql="INSERT INTO spazzo.image(uid,title,description,file) VALUES('$id','$title','$text','$image')";
    //var_dump($sql);
    $result = $conn->query($sql);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
  	$msg = "Failed to upload image";
    }
    if(!$result){
        echo "<script>alert('Error! Please Retry');document.location='new.php'</script>";
    }else{
        echo "<script>alert('Upload Successful!');document.location='userdashboard.php'</script>";
    }
    
} 
