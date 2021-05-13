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
    <link rel="stylesheet" href="../assets/css/driver/dash.css">
    <title>Kamu Driver</title>



    <style>
        .content2 {
            
            margin-top: 200px;
            font-family: 'Open Sans', sans-serif;

            align-items: center;
       
        }
        .group {
            font-size: x-large;
            display: inline-block;
            width: 50px;
            margin-top: 55px;
        }
        .form2{
            margin-left: 35%;
            font-size: x-large;
      
        }
        .button5{
            font-size:large;
            color: green;

        }
    </style>
</head>

<body>
    <div class="driver-dashboard">
        <?php include('dash-include/nav.php'); ?>
        <div class="content">
            <div class="container">
                <a href="accept-orders" class="card" id="card1" style="display: block;">
                    <i class="fas fa-inbox"></i>
                    <div class="container">
                        <h4><b>Accept Orders</br></b></h4>
                    </div>
                </a>

                <a href="earnings" class="card" id="card3" style="display: block;">
                    <i class="fas fa-money-check-alt"></i>
                    <div class="container">
                        <h4><b>Earnings</br></b></h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="content2">
        <h2 style="text-transform: capitalize; margin-left: 450px;">Driver Availability</h2>


        <form class="form2" action="../driver/update-status?id=<?php echo $_SESSION['loggedin']['user_id']; ?>" method="post">
            <input type="hidden" value="$_SESSION['loggedin']['user_id']" name="user_id"><br>
            <div class="group">
                <select name="status">
                    <option value="1"><b>Available</b></option>
                    <option value="0"><b>Not Available</b></option>
                </select>
                <?php echo $status; ?>

            </div><br>
            <input class="button5" type="submit" name='submit2' value="Update Status" size="25"><br>
        </form>
    </div>





</body>

</html>