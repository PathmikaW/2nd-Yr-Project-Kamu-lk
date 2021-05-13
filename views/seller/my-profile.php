<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../auth/login');
    die();
}
?>



<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/seller/dash.css">
    <link rel="stylesheet" href="../assets/css/seller/forms.css">
    <title>My Profile</title>
</head>

<body>
    <div class="seller-dashboard">
        <?php include('dash-include/my_profile_nav.php'); ?>
        <div class="content">
            <div class="container">
                <a href="view-order" class="card" id="card1" style="display: block;">
                    <i class="fas fa-sort-amount-up-alt"></i>
                    <div class="container">
                        <h4><b>Orders</br><?php echo $count['count(*)'] ?></b></h4>
                    </div>
                </a>
                <a href="view-food-item" class="card" id="card2" style="display: block;">
                    <i class="fas fa-cloud-meatball"></i>
                    <div class=" container">
                        <h4><b>Food Items</br></b></h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    </div>

    <div class="food-form form-container">
        <h2 style="text-transform: capitalize; display: inline-block; width: 150px; height: 25px; margin-left: 450px;"> My Profile</h2><br>

        <form class="form" action="../seller/my-profile?id=<?= $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Seller ID</label>
                <input class="form-control" type="text" name="id" size="50" value="<?php echo $id; ?>" autocomplete="off" readonly><br>
                <label>Seller Name</label>
                <input class="form-control" type="text" name="sellername" size="50" value="<?php echo $seller_name; ?>" placeholder="" required><br>
                <span class="invalidFeedback">
                    <?php echo $usernameError; ?>
                </span><br>
                <label>Restaurant Name</label>
                <input class="form-control" type="text" name="resname" size="50" value="<?php echo $res_name; ?>" placeholder="" required><br>

                <label>Restaurant Address</label>
                <input class="form-control" type="text" name="resaddress" size="50" value="<?php echo $res_address; ?>" placeholder="
                " required><br>
                <label>Contact Number</label>
                <input class="form-control" type="text" name="tele" size="50" value="<?php echo $tele; ?>" placeholder="Enter Your Contact number here" required><br>
                <label>E-mail</label>
                <input class="form-control" type="text" name="email" size="50" value="<?php echo $email; ?>" placeholder="" required><br>
                <span class="invalidFeedback">
                    <?php echo $emailError; ?>
                </span><br>
                    <label>Image</label>
                    <img width="100px" height="100px" src="<?= "../" . $image ?>" alt="">

                <input type="file" name="fileToUpload" id="lastName" class="form-control form-control-danger" placeholder="12n">


            </div>
            <input class="buttonn" type="submit" name='submit2' value="Update Profile" size="25"><br>
        </form><br>
        <a style="margin-left:450px" href="change-password"> <button class="buttonn">Change Password</button></a><br>
    </div>

</body>

</html>