<?php
    session_start();
    if(!isset($_SESSION['loggedin'])) {
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
    <link rel="stylesheet" href="../assets/css/driver/dash.css">
    <link rel="stylesheet" href="../assets/css/driver/profile.css">
    <link rel="stylesheet" href="../assets/css/driver/profile.css">
    <title>Driver Profile</title>
 
</head>

<body>
    <div class="driver-dashboard">
        <?php include('dash-include/my_profile_nav.php'); ?>
        <div class="content">
            <div class="container">
                <a href="accept-orders" class="card" id="card1" style="display: block;">
                    <i class="fas fa-inbox"></i>
                    <div class="container">
                        <h4><b>Accept Orders</br></b></h4>
                    </div>
                </a>
                <a href="earnings" class="card" id="card3" style="display: block;">
                    <i class="fas fa-money-check-alt"></i>
                    <div class="container">
                        <h4><b>Earnings</br></b></h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="food-form form-container">
        <h2 style="text-transform: capitalize; display: inline-block; width: 150px; height: 25px; margin-left: 450px;"> My Profile</h2><br>

        <form class="form2" action="../driver/my-profile?id=<?= $id; ?>" method="post">
            <div class="form-group">
                <label>Driver ID</label>
                <input class="form-control" type="text" name="id" size="50" value="<?php echo $id; ?>" autocomplete="off"  readonly><br>
                <label>Driver Name</label>
                <span class="invalidFeedback">
                    <?php echo $usernameError; ?>
                    </span><br>
                <input class="form2" type="text" name="drivername" size="50" value="<?php echo $drivername; ?>" placeholder="" required><br>
                <label>NIC</label>
                <input class="form2" type="text" name="nic" size="50" value="<?php echo $nic; ?>" placeholder="" required><br>
                
  
                <label>License ID</label>
                <input class="form-control" type="text" name="license" size="50" value="<?php echo $license; ?>" placeholder="
                " required><br>
              
                                               
                <label>Contact Number</label>
                <input class="form-control" type="text" name="tele" size="50" value="<?php echo $tele; ?>" placeholder="" required><br>
                <label>E-mail</label>
                <input class="form-control" type="text" name="email" size="50" value="<?php echo $email; ?>" placeholder="" required><br>
                <span class="invalidFeedback">
                    <?php echo $emailError; ?>
                </span><br>
            </div>
            <input class="button" type="submit" name='submit2' value="Update Profile" size="25"><br>
        </form><br>
        <a style="margin-left:400px" href="change-password"> <button class="button">Change Password</button></a>
    </div>

</body>

</html>