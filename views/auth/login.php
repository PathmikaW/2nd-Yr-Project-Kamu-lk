<?php
    session_start();
    if(isset($_SESSION['loggedin']))
    { 
        if ($_SESSION['loggedin'] == 2) {
            header('Location: ../nutritionist/dashboard');
        }
        die();
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="../assets/css/main/login.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/main/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
	</head>
	<body>
        <div class="container"> 
            <div class="navbar">
                <div class="logo">
                    <img src="../assets/images/logo.png" alt="logo" width="150spx">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="../main/index">Home</a></li>
						<li><a href="../main/blog">Blog</a></li>
                        <li><a href="../main/restaurant">Restaurants</a></li>
                        <li><a href="../main/about-us">About Us</a></li>
						<li><a href="login" class="btn">Login</a></li>
                    </ul>
				</nav>
				<img src="../assets/images/menu.png" class="menu-icon" alt="menu" onclick="menutoggle()">
			</div>
			<div class="row">
				<div class="col-2">
                    <img src="../assets/images/rest.jpg" alt="login image">
                </div>
				<div class="col-2">
                    <div class="formBox">
                    <h1>Login</h1>
                        <form action="../auth/login" method="POST">
                            <p>Username</p>
                            <input type="text" name="username" placeholder="Enter username" autocomplete="off">
                                <span class="invalidFeedback">
                                    <?php echo $usernameError;?>
                                </span>
                            <p>Password</p>
                            <input type="password" name="password" placeholder="Enter password">
                                <span class="invalidFeedback">
                                    <?php echo $passwordError;?>
                                </span>
                            <input type="submit" value="Login"><br>
                            <a href="../auth/forgot-password">Forgot Password</a><br>
                            <h4>Not registered yet? <a href="../main/index#SignUp">Create an account!</a></h4>
                        </form>
                    </div>
                </div>
			</div>
		</div>
		<Script>
            var MenuItems = document.getElementById("MenuItems");
            MenuItems.style.maxHeight = "0px";
            
            function menutoggle(){
                if(MenuItems.style.maxHeight == "0px"){
                    MenuItems.style.maxHeight = "250px";
                }
                else{
                    MenuItems.style.maxHeight = "0px";
                }
            } 
        </Script>
</body>
</html>