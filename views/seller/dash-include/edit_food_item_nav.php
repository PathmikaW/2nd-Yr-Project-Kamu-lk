<div class="navbar">
    <div class="logo">
        <img src="../assets/images/seller/logo.png" alt="logo" width="125px">
    </div>
    <div class="nav-right">
        <h3>Hi Seller</h3>
        <div class="dropdown">
            <button class="dropbtn"><img src="../assets/images/seller/seller_icon.png" alt="user" width="50px"></button>
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
        <li><a href="my-profile?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Restaurant Profile</a></li>
        <li> Food Menu
            <ul style="display: inline;">
                <li><a href="add-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>">Add Food Items</a></li>
                <li>
                    <m><a href="edit-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>">Edit Food Items</a></m>
                </li>
                <li><a href="view-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>">View Food Items</a></li>
            </ul>
        </li>
        <li>Order Details
            <ul style="display: inline;">
                <li><a href="view-order?id=<?php echo $_SESSION['loggedin']['user_id']; ?>">View Order details</a></li>
            </ul>
        </li>
        <li><a href="contact-admin?id=<?php echo $_SESSION['loggedin']['user_id'];?>">Contact Administrator</a></li>
    </ul>
</div>