<?php
session_start();
if(isset($_SESSION['username'])) {
    header("location:welcomeemployee.php");
}
if(isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $link = mysqli_connect("localhost", "root", "", "project") or die($link);
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    $result = mysqli_query($link, "SELECT * FROM employee WHERE uname='$username' AND password='$password'") or die("Failed to query database".mysqli_error($link));

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["username"] = $username;
        header("location: welcomeemployee.php");
    } else {
        echo "<script>alert('Invalid ID or Password.');</script>";
    }

    mysqli_close($link);
}
if (isset($_POST['btn'])) {
    $funame = $_POST['funame'];
    $conn = mysqli_connect("localhost", "root", "", "project") or die("connection failed".mysqli_connect_error());
    $query = "SELECT * FROM employee WHERE uname = '$funame'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            $uname = $row['uname'];
            $password = $row['password'];
            $email = $row['email'];

            if ($funame == $uname) {
                $mailto = $email;
                $mailsub = 'Password';
                $mailmsg = 'Your forgotten Password Request Is Received. Your Password is here: ' . $password . '. Use this password to login. Thank You.';
                error_reporting(E_ALL);
                require("PHPMailer_5.2.4/class.phpmailer.php");

                $mail = new PHPMailer();

                $mail->IsSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = 'your_email@gmail.com'; // Replace with your email
                $mail->Password = 'your_password'; // Replace with your email password
                $mail->From = 'your_email@gmail.com'; // Replace with your email
                $mail->FromName = 'Your Name'; // Replace with your name
                $mail->IsHTML(true);

                $mail->Subject = $mailsub;
                $mail->Body = $mailmsg;
                $mail->AddAddress($mailto);

                if ($mail->Send()) {
                    echo "<script>alert('Mail Sent Successfully')</script>";
                    echo "<script>location.href='employeelogin.php'</script>";
                } else {
                    echo "<script>alert('Failed To Send Mail, Verify Your mail Address.')</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Username Does Not Exist, Enter Your Valid Username.');</script>";
    }

    mysqli_close($conn);
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap-v3/css/bootstrap.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f5f5;
        }
        .login-box {
            width: 360px;
            height: 420px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            padding: 70px 40px;
        }
        .avatar {
            width: 185px;
            height: 150px;
            border-radius: 50%;
            position: absolute;
            top: -28%;
            left: calc(50% - 91px);
        }
        .login-box h2 {
            text-align: center;
            color: crimson;
        }
        .login-box p {
            margin: 0;
            padding: 0;
            font-weight: bold;
            color: crimson;
        }
        .login-box input {
            width: 100%;
            margin-bottom: 20px;
        }
        .login-box input[type="text"], .login-box input[type="password"] {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 25px;
            color: #fff;
            font-size: 16px;
        }
        .login-box input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: crimson;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            cursor: pointer;
        }
        .login-box input[type="submit"]:hover {
            background: #30DC59;
            color: #1c8adb;
        }
        .login-box a {
            text-decoration: none;
            font-size: 14px;
            color: #fff;
        }
        .login-box a:hover {
            color: #1c8adb;
        }
        .modal {
            top: 180px;
        }
    </style>
</head>
<body>
    <header id="header">
        <div class="container-fluid">
            <div id="logo" class="pull-left">
                <h1><a href="home.php" class="scrollto">Employee Login</a></h1>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="adminlogin.php">Admin Login</a></li>
                    <li class="menu-active"><a href="#intro">Employee Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
         <!-- Carousel -->
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/slide1.jpg" alt="Slide 1">
                    <div class="carousel-caption">
                        <h3>Welcome to Employee Portal</h3>
                        <p>Your journey starts here!</p>
                    </div>
                </div>
                <div class="item">
                    <img src="img/slide2.jpg" alt="Slide 2">
                    <div class="carousel-caption">
                        <h3>Secure and Reliable</h3>
                        <p>Ensuring your data safety</p>
                    </div>
                </div>
                <div class="item">
                    <img src="img/slide3.jpg" alt="Slide 3">
                    <div class="carousel-caption">
                        <h3>Easy Access</h3>
                        <p>Access your details anytime, anywhere</p>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        <div class="login-box">
            <img src="img/employee.png" class="avatar" alt="Image Not Found">
            <h2><b>Employee</b></h2>
            <form action="#" method="POST">
                <p>Username</p>
                <input type="text" name="user" id="user" placeholder="Enter Email ID" autocomplete="off">
                <p>Password</p>
                <input data-toggle="password" data-placement="after" class="form-control" type="password" placeholder="Enter Password" data-eye-class="material-icons" data-eye-open-class="visibility" data-eye-close-class="visibility_off" data-eye-class-position-inside="true" name="pass" id="pass">
                <input type="submit" id="btn" name="submit" value="Login">
                <u><a href="#" data-toggle="modal" data-target="#myModal">Have you forgotten your password?</a></u>
            </form>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="padding:30px 40px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> Forgot Password</h4>
                    </div>
                    <div class="modal-body" style="padding:30px 40px;">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="uname"><span class="glyphicon glyphicon-user"></span> Username</label>
                                <input type="text" class="form-control" name="funame" id="funame" placeholder="Enter your Email ID">
                            </div>
                            <button type="submit" name="btn" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Send Me Password</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
