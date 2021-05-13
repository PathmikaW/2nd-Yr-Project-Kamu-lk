<div class="navbar">
    <div class="logo">
        <img src="../assets/images/driver/logo.png" alt="logo" width="125px">
    </div>
    <div class="nav-right">
        <h3>Hi Driver</h3>
        <div class="dropdown">
            <button class="dropbtn"><img src="../assets/images/driver/driver_icon.png" alt="user" width="50px"></button>
            <div class="dropdown-content">
                <a href="my-profile?id=<?php echo $_SESSION['loggedin']['user_id'];?>">My Profile</a>
                <a href="logout">Log Out</a>
            </div>
        </div>
    </div>
</div>
<div class="sidebar">
    <ul>
        <li> <a href="dash">DASHBOARD</a></li>
        <li><a href="my-profile?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Edit Profile</a></li>
        <li>Orders
            <ul style="display: inline;">
                <li><a href="accept-orders">Order Inbox</a></li>
                <li>
                    <m><a href="earnings">Earnings</a></m>
                </li>
            </ul>
        </li>
        <li><a href="contact-admin?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Contact Administrator</a></li>
    </ul>
</div>