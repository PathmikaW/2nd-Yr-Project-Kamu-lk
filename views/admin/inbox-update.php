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
    <title>Inbox Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/forms.css">
</head>

<body>
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <div class="content" style="position:relative; top:120px; left:340px;">
            <div class="user-form form-container">
                <h2 style="text-transform: capitalize;">Update User Details</h2><br>
                <form class="form" action="../admin/inbox-update?id=<?php echo $id;?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="email" size="50" value="<?php echo $username;?>"
                            autocomplete="off" placeholder="Enter Name Here" required><br>
                        <label>Subject/label>
                            <input class="form-control" type="text" name="username" size="50"
                                value="<?php echo $subject;?>" autocomplete="off" placeholder="Enter the Subject"
                                required><br>
                            <label>Message</label>
                            <input class="form-control" type="text" step=1 name="user_type_id" size="100"
                                value="<?php echo $message;?>" autocomplete="off" placeholder="Enter the Message"
                                required><br>
                            <label>Reply</label>
                            <input class="form-control" type="text" step=1 name="user_type_id" size="100"
                                value="<?php echo $reply;?>" autocomplete="off" placeholder="Enter the Reply"
                                required><br>
                    </div>
                    <input class="button" type="submit" name='submit2' value="Reply" size="25">

                </form>
            </div>
        </div>
</body>

</html>