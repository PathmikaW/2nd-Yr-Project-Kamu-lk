<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kamu.lk | About Us</title>
    <link rel="stylesheet" href="../assets/css/main/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container"> 
        <div class="navbar">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="logo" width="150px">
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index">Home</a></li>
                    <li><a href="blog">Blog</a></li>
                    <li><a href="restaurant">Restaurants</a></li>
                    <li><a href="about-us">About Us</a></li>
                    <li><a href="../auth/login" class="btn">Login</a></li>
                </ul>
            </nav>
            <img src="../assets/images/menu.png" class="menu-icon" alt="menu" onclick="menutoggle()">
        </div>
        
		<div class="row">
            <div class="col-2">
                <h1>About Us</h1><br>
				<h2> Healthy food make you feel good!</h2><br>
				<p>Kamu.lk is a web-based application to increase  promoting the healthy food habits in 
				Sri Lanka as well as delivering awareness on healthy dietary  food products to the doorsteps.
				Kamu.lk also provides information regarding Traditional Foods, Cooking tutorials and Recipes on a blog called KamuWiki. 
				The main intention of KamuWiki is to encourage people to try new recipes and give correct information about traditional food. </p><br>

				<p>Kamu.lk provides a space for sellers to market their food products.
				Therefore, registered users can easily find the outlet locations, food products and rating and comments to choose the outlets. 
				Kamu.lk motivates and encourages the minor employees , people who want to be entrepreneurs as well as delivery people
				 to earn some money and other benefits Kamu.lk is the best choice.</p><br>
			
				<p>Kamu.lk  users can contact nutritionist , get advice from nutritionist and the dietary meal plans ,
				according to that they can search for outlets and order and get the food delivered to their doorstep .
				They can view search add   tutorials , articles , blogs ,videos in the kamu.lk. 
				Kamu.lk people can get to  know about various cultural traditional foods where there are alot that  people are aware of.
				Kamu.lk  mainly focus on encouraging people on healthy food habits and uplifting the traditional food behaviour of various cultures of Sri lankans .</p><br> 
                </div>
                <div class="col-2">
                    <img src="../assets/images/about_us.png" alt="about us">
                </div>
            </div>
        </div><br>
	<!------ footer------>
	<div class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col-1">
                        <img src="../assets/images/logo.png" alt="logo">
                        <p>We promote healthy food habits in order to prevent<br>
                            non-communicable diseases in the Sri Lankan community.</p>
                    </div>
                    <div class="footer-col-2">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="restaurant">Restaurant</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Terms of Service</a></li>
                            <li><a href="">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="footer-col-2">
                        <h3>Follow Us</h3>
                        <ul>
                            <li><a href="">Facebook</a></li>
                            <li><a href="">Twitter</a></li>
                            <li><a href="">Instagram</a></li>
                            <li><a href="">YouTube</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <p class="copyright"> Copyright 2020 - Kamu.lk</p>
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