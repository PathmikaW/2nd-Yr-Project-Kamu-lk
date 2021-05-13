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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/forms.css">
</head>

<body>
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <div class="content">
            <div class="user-form form-container">
                
                <form class="form" action="../admin/user-add" method="post" style="position:relative; top:120px; left:340px;">
                    <h2 style="text-transform: capitalize; color:black;">Add User Details</h2><br>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" size="50" value="" autocomplete="off"
                            placeholder="Enter user Email Here" required><br>

                        <label>Username</label>
                        <input class="form-control" type="text" name="username" size="50" value="" autocomplete="off"
                            value="" placeholder="Username" required><br>

                        <label>Password</label>
                        <input class="form-control" type="password" name="password" size="50" value=""
                            placeholder="Password" required><br>

                        <label>User-Type</label>
                        <select name="user_type_id" id="user_type_id" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Nutritionist</option>
                            <option value="3">User</option>
                            <option value="4">Seller</option>
                            <option value="5">Driver</option>
                        </select>
                    </div>
                    <span class="invalidFeedback"> <?php echo $Error;?> </span>
                    <input class="button" type="submit" name='submit2' value="Submit">
                    <input class="button" type="reset" value="Reset">
                </form>
            </div>
        </div>
</body>

</html>