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
    <title>Admin Profile</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/forms.css">
</head>

<body>
    <?php include('nav.php'); ?>
    <div class="content">
        <div class="user-form form-container">
            <form class="form" action="../admin/my-profile?id=<?php echo $id;?>" method="post"
                style="position:relative; top:120px; left:340px;">
                <h2 style="text-transform: capitalize; color:black;">Profile</h2><br>
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username" size="50" autocomplete="off"
                        value="<?php echo $username;?>" placeholder="Enter Your Username here" required><br>
                    <span class="invalidFeedback">
                        <?php echo $usernameError;?>
                    </span><br>
                    <label>Email</label>
                    <input class="form-control" type="text" name="email" size="50" value="<?php echo $email;?>"
                        placeholder="Enter Your Email here" required><br>
                    <span class="invalidFeedback">
                        <?php echo $emailError;?>
                    </span><br>
                </div>
                <input class="button" type="submit" name='submit2' value="Update Profile" size="25"><br>
            </form><br>
            <a style="position:relative; top: -55px; left:-580px;" href="change-password"> <button style="width: 250px;"
                    class="button">Change Password</button></a>

        </div>
    </div>
</body>

</html>