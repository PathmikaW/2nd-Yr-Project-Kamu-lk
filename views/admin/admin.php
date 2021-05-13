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
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">

</head>

<body class="body">
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <div class="content">
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #032959; position:relative; top:120px; left:300px;">
                    <tr>
                        <td colspan="2" rowspan="5">
                            <h3>Users</h><br>
                                <br>
                                <i class="fa fa-user fa-3x"></i><br>
                                <h3>Total System Users<h3><br><b>
                                            <h5><i class="fa fa-user"></i> <?php echo $allUserCount;?></h5><br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #032959; position:relative; top:120px; left:300px;">
                    <tr>
                        <td colspan="2" rowspan="5">
                            <h3>Revenue</h><br>
                                <br>
                                <i class="fas fa-dollar-sign fa-3x"></i><br>
                                <h3>Total Delivery Revenue <h3><br><b>
                                            <h5><i class="fas fa-dollar-sign"></i>
                                                <?php   foreach($totalPayable as $totalPayables) { 
                            foreach($totalRecievable as $totalRecievables) {
                    echo ($totalRecievables['Totalrecievable'] - $totalPayables['Totalpayable'] );
                            }
                          }
                  
                  ?> LKR</h5><br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #009E60; position:relative; top:120px; left:300px;">
                    <tr>
                        <td colspan="2" rowspan="5">
                            <h3>Orders<h3>
                                    <br><i class="fa fa-shopping-cart fa-3x"></i><br><br>
                                    <p>Total Order Recieved</p>
                                    <br><b>
                                        <h5><i class="fa fa-trophy"></i> <?php echo $orderCount;?></h5><br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #009E60; position:relative; top:120px; left:300px;">
                    <tr>
                        <td colspan="2" rowspan="5">
                            <h3>Diet Plans<h3>
                                    <br><i class="fa fa-heartbeat fa-3x"></i><br><br>
                                    <p>Total Diet Requests Recieved</p>
                                    <br><b>
                                        <h5><i class="fa fa-heart"></i> <?php echo $allMealPlan;?></h5><br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #337ab7; position:relative; top:120px; left:300px;">
                    <tr>
                        <td colspan="2" rowspan="5"><br><br>
                            <br><i class="fa fa-user fa-3x"></i><br>
                            <h3>Registered User<h3>
                                    <br><i class="fa fa-database" aria-hidden="true"></i>&#8287 &#8287
                                    <b><?php echo $reguserCount;?></b>
                                    <p></p><br><br>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #5cb85c; position:relative; top:120px; left:300px;">
                    <tr>
                        <td colspan="2" rowspan="5"> <br> <br>
                            <br><i class="fa fa-shopping-bag fa-3x"></i><br>
                            <h3>Sellers<h3>
                                    <br><i class="fa fa-database" aria-hidden="true"></i>&#8287 &#8287
                                    <b><?php echo $sellerCount;?> </b>
                                    <br>
                                    <p></p>
                                    <br><br>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table" style="background-color: #FFC300;  top:120px; left:100px; ">
                    <tr>
                        <td colspan="2" rowspan="5"><br> <br>
                            <br><i class="fa fa-truck fa-3x"></i><br>
                            <h3>Delivery Person<h3><br><b><i class="fa fa-database" aria-hidden="true"></i>&#8287 &#8287
                                        <b><?php echo $driverCount;?></b>

                                        <br>
                                        <p></p>
                                        <br><br>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tableview">
                <table class="sitestats" class="table"
                    style="background-color: #FF5733; position:relative; top:120px; left:100px;">
                    <tr>
                        <td colspan="2" rowspan="5"> <br><br>
                            <br><i class="fa fa-heart fa-3x"></i><br>
                            <h3>Nutritionist<h3><br><b><i class="fa fa-database" aria-hidden="true"></i>&#8287 &#8287
                                        <?php echo $nutritionistCount;?></b>

                                    <br>
                                    <p></p>
                                    <br><br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>


</html>