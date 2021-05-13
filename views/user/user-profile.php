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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title>Kamu Nutritionist | Profile</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main/login.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/foodForm.css"> 
    <link rel="stylesheet" href="../assets/css/nutritionist/forms.css">
</head>

<body>
<?php include('dash_include/nav.php'); ?>
    <div class="content">
        <div class="food-form form-container">
            <h2 style="text-transform: capitalize;">My Profile</h2><br>
            <form class="form" action="../user/user-profile?id=<?php echo $id;?>" method="post"> 
                <div class="form-group">
                    <label>Name</label>
                        <input class="form-control" type="text" name="name" size="50" 
                            value="<?php echo $name;?>" autocomplete="off" placeholder="Enter Your Name here" required><br>
                    <label>Username</label>
                        <input class="form-control" type="text" name="username" size="50"
                            value="<?php echo $username;?>" placeholder="Enter Your Username here" required><br>
                                <span class="invalidFeedback">
                                    <?php echo $usernameError;?>
                                </span><br>
                    <label>Email</label>
                        <input class="form-control" type="text" name="email" size="50"
                            value="<?php echo $email;?>" placeholder="Enter Your Email here" required><br> 
                                <span class="invalidFeedback">
                                    <?php echo $emailError;?>
                                </span><br>    
                    <label>Contact Number</label>
                        <input class="form-control" type="text" name="tele_no" size="50"
                            value="<?php echo $tele_no;?>" placeholder="Enter Your Contact number here" required><br>                      
                </div> 
                <input class="button" type="submit" name='submit2' value="Update Profile" size="25"><br>
            </form><br>
            <a style="margin-left:250px" href="change-password"> <button class="button">Change Password</button></a>
        </div>
    </div>                  
</body>
</html>
