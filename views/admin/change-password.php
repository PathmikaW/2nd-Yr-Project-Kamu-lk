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
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/forms.css">
</head>

<body>
    <?php include('nav.php'); ?>
    <div class="content">
        <div class="user-form form-container">
            <form class="form" action="../admin/change-password?id=<?php echo $_SESSION['loggedin']['user_id'];?>"
                style="position:relative; top:120px; left:340px;" method="post">
                <h2 style="text-transform: capitalize;color:black;">Change Password</h2><br>
                <div class="form-group">
                    <label>Current Password</label>
                    <input class="form-control" type="password" name="currentPassword" size="50" value=""
                        placeholder="Enter Your Current Password here" required><br>
                    <span class="invalidFeedback">
                        <?php echo $error;?>
                    </span><br>

                    <label>New Password</label>
                    <input class="form-control" type="password" name="password" size="50" value=""
                        placeholder="Enter Your New Password here" required><br>
                    <span class="invalidFeedback">
                        <?php echo $passwordError;?>
                    </span><br>

                    <label>Confirm Password</label>
                    <input class="form-control" type="password" name="confirmPassword" size="50" value=""
                        placeholder="Confirm your Password" required><br>
                    <span class="invalidFeedback">
                        <?php echo $confirmPasswordError;?>
                    </span><br>
                </div>
                <input class="button" type="submit" name='submit2' value="Change Password" size="25">
            </form>
        </div>
    </div>
</body>

</html>