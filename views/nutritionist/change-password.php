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
    <title>Kamu Nutritionist | Change Password</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main/login.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/foodForm.css"> 
    <link rel="stylesheet" href="../assets/css/nutritionist/forms.css">
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-form form-container">
            <h2 style="text-transform: capitalize;">Change Password</h2><br>
            <form class="form" action="../nutritionist/change-password?id=<?php echo $_SESSION['loggedin']['user_id'];?>" method="post"> 
                <div class="form-group">
                    <label>Current Password</label>
                        <input class="form-control" type="password"name="currentPassword" size="50"
                            value="" placeholder="Enter Your Current Password here" required><br>
                                <span class="invalidFeedback">
                                    <?php echo $error;?>
                                </span><br>

                    <label>New Password</label>
                        <input class="form-control" type="password"name="password" size="50"
                            value="" placeholder="Enter Your New Password here" required><br>
                                <span class="invalidFeedback">
                                    <?php echo $passwordError;?>
                                </span><br>

                    <label>Confirm Password</label>
                        <input class="form-control" type="password"name="confirmPassword" size="50"
                            value="" placeholder="Confirm your Password" required><br>
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
