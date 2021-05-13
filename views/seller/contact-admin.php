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


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/seller/dash.css">
    <link rel="stylesheet" href="../assets/css/seller/forms.css">

    <title>Contact Admin</title>
</head>

<body>
    <div class="seller-dashboard">
        <?php include('dash-include/contact_admin_nav.php'); ?>
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

    <div class="content">
        <div class="food-form form-container">
            <h2 style="text-transform: capitalize; margin-left: 450px;">Contact Administrator</h2><br>
            <form class="form" action="../seller/contact-admin?id=<?php echo $_SESSION['loggedin']['user_id']; ?>" method="post">
                <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" type="text" name="subject" size="50" value="" autocomplete="off" placeholder="Enter Your Subject" required><br>
                    <label>Message</label>
                    <textarea class="form-control" name="message" placeholder="Message" style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" required></textarea><br>
                </div>
                <input class="button" type="submit" name='submit2' value="submit" size="25">
                <input class="button" type="reset" value="reset" size="25">
            </form>
        </div>
    </div>
</body>

</html>