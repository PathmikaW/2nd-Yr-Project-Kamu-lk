<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kamu.lk | Detail</title>
        <link rel="stylesheet" href="../assets/css/main/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container"> 
            <div class="navbar">
                <div class="logo">
                    <img src="images/logo.png" alt="logo" width="125px">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="restaurant.php">Restaurants</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="log.php" class="btn">Login</a></li>
                    </ul>
                </nav>
                <img src="images/menu.png" class="menu-icon" alt="menu" onclick="menutoggle()">
            </div>
        </div>
    <!------ features categories ------>

    <div class="categories">
        <div class="small-container">
                <?php
                    require_once("connect.php");
                    
                    $id = $_GET['id'];
                            
                    if($id != "") {
                        $sql = "SELECT * FROM restaurant WHERE id='".$id."' LIMIT 1";
                        $result = $con->query($sql);

                    if($result->num_rows>0){
                        while($row = $result-> fetch_assoc()){
                ?>
                <div class="row">
                    <div class="col-2">
                        <h1><?php echo $row['name']; ?></h1>
                        <h3><?php echo $row['location']; ?></h3>
                        <p><?php echo $row['description']; ?> </p><br><br><br><br><br><br>
                    </div>
                    <div class="col-2">
                            <img src="<?php echo $row['image']; ?>" alt="restaurant image" width="450px" style="padding-left:60px;">
                    </div>
                </div>

            <?php
                       
                        }
                    }
                }
                else{
                    echo "No restaurant found";
                }
            ?>
            </div>
        </div>    
    </div>

    <!------ footer------>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col-1">
                        <img src="images/logo.png" alt="logo">
                        <p>We promote healthy food habits in order to prevent<br>
                            non-communicable diseases in the Sri Lankan community.</p>
                    </div>
                    <div class="footer-col-2">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="restaurant.php">Restaurant</a></li>
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