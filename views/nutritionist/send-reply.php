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
    <title>Kamu Nutritionist | reply</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/foodForm.css"> 
    <link rel="stylesheet" href="../assets/css/nutritionist/forms.css">
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-form form-container">
            <h2 style="text-transform: capitalize;">Send Reply</h2><br>
            <form class="form" action="../nutritionist/send-reply?id=<?php echo $id;?>" method="post">
                <div class="form-group">
                    <input type="hidden" name="from" value="2">
                    <input type="hidden" name="email" value="<?php echo $_SESSION['loggedin']['email'];?>">
                    <label>Email</label>
                        <input class="form-control" type="text"  name="email" size="50" value="<?php echo $email;?>"  disabled><br>
                    <label>Subject</label>
                        <input class="form-control" type="text"  name="subject" size="50" value="<?php echo $subject;?>" disabled><br>
                    <label>Message</label>
                        <textarea class="form-control" name="message" value="<?php echo $message;?>"
                            style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" disabled><?php echo $message;?></textarea><br>
                    <label>Reply</label>
                        <textarea class="form-control" name="reply" placeholder="Enter Reply" 
                            style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" required></textarea><br>                         
                </div>
                <input class="button" type="submit" name='submit2' value="Send" size="25">
            </form>
        </div>
    </div>
</body>
</html>