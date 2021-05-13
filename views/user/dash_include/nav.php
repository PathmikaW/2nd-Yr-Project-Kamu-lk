<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/user/nav.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-menu">
                <div ><img src="../assets/images/logo.png" alt="logo" width="125px"></div>
                <div class="username">Hi <?php echo $_SESSION['loggedin']['username'];?></div>
                <div class="dropdown">
                    <button class="dropbtn"><img  src="../assets/images/user/user_icon.png" alt="user" width="40px"></button>
                        <div class="dropdown-content">
                            <a href="user-profile?id=<?php echo $_SESSION['loggedin']['user_id'];?>">My Profile</a>
                            <a href="logout">Log Out</a>
                        </div>
                </div>
            </div>
        </div>
        <nav class="sidebar">
            <ul>
                <li><a href="user-dash"><i class="fas fa-align-justify"></i>&#8287 &#8287 Dashboard</a></li>
                <li>
                    <a href="#" class="food-btn"><i class="fas fa-paste"></i>&#8287 &#8287 Post
                        <span class="fas fa-caret-down first"></span>
                    </a>
                    <ul class="food-show">
                        <li><a href="add-post?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Add post</a></li>
                        <li><a href="view-post?id=<?php echo $_SESSION['loggedin']['user_id'];?>">View post</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="meal-btn"><i class="fas fa-burger-soda"></i>&#8287 &#8287 Order
                        <span class="fas fa-caret-down second"></span>
                    </a>
                    <ul class="meal-show">
                        <li><a href="order-food">Place Order</a></li>
                        <li><a href="view-cart?id=<?php echo $_SESSION['loggedin']['user_id'];?>">My cart</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="post-btn"><i class="fas fa-shopping-cart"></i>&#8287 &#8287 Request Mealplan
                        <span class="fas fa-caret-down third"></span>
                    </a>
                    <ul class="post-show">
                        <li><a href="request-meal-plan?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Request</a></li>
                        <li><a href="my-plan?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Meal Plan</a></li>
                    </ul>
                </li>
                
                <li><a href="contact-nutritionist?id=<?php echo $_SESSION['loggedin']['user_id'];?>"><i class="fas fa-user-md"></i>&#8287 &#8287 Contact Nutritionist</a></li>
                
                <li><a href="contact-admin?id=<?php echo $_SESSION['loggedin']['user_id'];?>"><i class="fas fa-question-circle"></i>&#8287 &#8287 Contact Administrator</a></li>
                
                <li><a href="user-inbox?id=<?php echo $_SESSION['loggedin']['user_id'];?>"><i class="fas fa-inbox-in"></i>&#8287 &#8287 Inbox</a></li>
            </ul>
        </nav>
    </div>

<script>
        $('.food-btn').click(function(){
            $('nav ul .food-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });

        $('.meal-btn').click(function(){
            $('nav ul .meal-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });

        $('.post-btn').click(function(){
            $('nav ul .post-show').toggleClass("show2");
            $('nav ul .third').toggleClass("rotate");
        });

</script>
</body>
</html>
                           