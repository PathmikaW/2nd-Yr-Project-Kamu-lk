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
    <style>

    </style>

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
        <h2 style="text-transform: capitalize; display: inline-block; width: 250px; height: 25px; margin-left: 400px;">Change Password</h2><br>
        <form class="form" action="../seller/change-password?id=<?php echo $_SESSION['loggedin']['user_id']; ?>" method="post">
            <div class="form-group">
                <label>Current Password</label>
                <input class="form-control" type="password" name="currentPassword" size="50" value="" placeholder="Enter Your Current Password here" required><br>
                <span class="invalidFeedback">
                    <?php echo $error; ?>
                </span><br>

                <label>New Password</label>
                <input class="form-control" type="password" name="password" size="50" value="" placeholder="Enter Your New Password here" required><br>
                <span class="invalidFeedback">
                    <?php echo $passwordError; ?>
                </span><br>

                <label>Confirm Password</label>
                <input class="form-control" type="password" name="confirmPassword" size="50" value="" placeholder="Confirm your Password" required><br>
                <span class="invalidFeedback">
                    <?php echo $confirmPasswordError; ?>
                </span><br>
            </div>
            <input class="button" type="submit" name='submit2' value="Change Password" size="25">
        </form>
    </div>

</body>

</html>