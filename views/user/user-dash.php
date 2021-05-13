<?php
    session_start();
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../auth/login');
        die();
    }
    else{
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fontawesome.com/"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/user/dash.css">

    <title>User Dashboard</title>
</head>
<body>
    <div class="user-dashboard">
        <?php include('dash_include/nav.php'); ?>
        <div class="content">
            <div class="container">
                <a href="dash_include/order.php" class="card" id="card1" style="display: block;">
                 <i class="fas fa-shopping-cart"></i>
                    <div class="container">
                        <h4><b> Orders</br></b ></h4>

                    </div>
                </a>
                <a href="add-post" class="card" id="card1" style="display: block;">
                    <i class="fas fa-arrow-alt-from-bottom"></i>
                    <div class=" container">
                        <h4><b>Post</br></b></h4>
                    </div>
                 </a>
                <a href="request-meal-plan" class="card" id="card1" style="display: block;">
                    <i class="fas fa-inbox-in"></i>
                    <div class="container">
                        <h4><b>Inbox</br></b></h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    
 </body>
</html>
