<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamu.lk | Contact Us</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main/login.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>
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
                <img src="../assets/images/contact.jpg" alt="login image">
            </div>
		    <div class="col-2">
                <div class="formBox">
                    <h1>Contact Us</h1>
                    <form action="../main/contact-us" method="POST">
                        <p style="color:green">Hotline: + 94 77 2342347</p>
                        <p style="color:green">Email: kamuproject@gmail.com</p><br>	
                        <p>Email</p>
                            <input type="email" name="email" autocomplete="off" placeholder="Enter Your Email" required><br>
                        <p>Meassage</p>
                            <textarea class="textarea" name="message" placeholder="Message" 
                            style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" required></textarea><br><br>
							<input type="submit" value="Send" name="submit" ><br><br>
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