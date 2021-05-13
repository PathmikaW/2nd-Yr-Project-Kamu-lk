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
    <title>Add Reply</title>
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
                
                <form class="form" action="../admin/reply-add?id=<?php echo $id;?>" method="post" style="position:relative; top:120px; left:340px;">
                    <h2 style="text-transform: capitalize; color:black;">Send Reply</h2><br>
                    <div class="form-group">
                        <input type="hidden" name="from" value="1">
                        <input type="hidden" name="email" value="<?php //echo $_SESSION['loggedin']['email'];?>">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" size="50" value="<?php echo $email;?>" autocomplete="off" 
                            placeholder="Enter user Email Here" required><br>

                        <label>Username</label>
                        <input class="form-control" type="text" name="subject" size="50" value="<?php echo $subject;?>" autocomplete="off"
                            value="" placeholder="Username" required><br>

                        <label>Message</label>
                        <textarea class="form-control" name="message" value="<?php echo $message;?>"
                            style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" disabled><?php echo $message;?></textarea><br>
                        
                        <label>Reply</label>
                        <textarea class="form-control" name="reply" value=""
                            style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" required></textarea><br>
                    </div>
                    <input class="button" type="submit" name='submit2' value="Send" size="25">
                </form>
            </div>
        </div>
</body>

</html>