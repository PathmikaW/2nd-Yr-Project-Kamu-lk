<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/admin/nav.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-menu">
                <div><img src="../assets/images/logo.png" alt="logo" width="125px"></div>
                <div class="dropdown">
                    <button class="dropbtn"><img src="../assets/images/admin/adminlogo.png" alt="user"
                            width="40px"></button>
                    <div class="dropdown-content">
                        <a href="my-profile?id=<?php echo $_SESSION['loggedin']['user_id'];?>">My Profile</a>
                        <a href="logout">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="sidebar">
            <ul>
                <li><a href="admin"><i class="fa fa-home fa-2x"></i>&#8287 &#8287 Dashboard</a></li>
                <li>
                    <a href="#" class="user-btn"><i class="fa fa-desktop fa-2x"></i>&#8287 &#8287 Manage Users
                        <span class="fas fa-caret-down first"></span>
                    </a>
                    <ul class="user-show">
                        <li><a href="user-add">Add Users</a></li>
                        <li><a href="user-view">View Users</a></li>
                    </ul>
                </li>
                <li><a href="manage-posts"><i class="fa fa-cogs fa-2x"></i> &#8287 Manage Posts</a></li>
                <li><a href="inbox-view"><i class="fa fa-envelope fa-2x"></i>&#8287 &#8287 &#8287 Inbox</a></li>
                <li>
                    <a href="#" class="trans-btn"><i class="fa fa-book fa-2x"></i> &#8287 &#8287 &#8287 Income
                        <span class="fas fa-caret-down second"></span>
                    </a>
                    <ul class="trans-show">
                        <li><a href="recievable-view"> &#8287 Recievable</a></li>
                        <li><a href="payable-view"> &#8287 Payable</a></li>
                        <li><a href="income-add"> &#8287 Add Transaction</a></li>
                    </ul>
                </li>
                <li><a href="seller-request"><i class="fa fa-hourglass-half fa-2x"></i> &#8287 &#8287 &#8287 Seller
                        Requests</a></li>
                <li><a href="driver-request"><i class="fa fa-truck fa-2x"></i> &#8287 Driver Requests</a></li>

            </ul>
        </nav>
    </div>

    <script>
    $('.user-btn').click(function() {
        $('nav ul .user-show').toggleClass("show");
        $('nav ul .first').toggleClass("rotate");
    });

    $('.trans-btn').click(function() {
        $('nav ul .trans-show').toggleClass("show1");
        $('nav ul .second').toggleClass("rotate");
    });
    </script>
</body>

</html>