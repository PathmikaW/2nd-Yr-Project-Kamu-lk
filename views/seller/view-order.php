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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/seller/dash.css">
    <link rel="stylesheet" href="../assets/css/seller/vorder.css">

    <title>View_Order</title>

</head>

<body>
    <div class="seller-dashboard">
        <?php include('dash-include/view_order_nav.php'); ?>
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
        <table id="view_order">
            <tr>
                <th>Order Id</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Order Status</th>
                <th>Order Action</th>
                <th colspan="2">Assign a Driver</th>

            </tr>
            <?php foreach ($data as $item) { ?>
                <tr>
                    <td><?php echo $item['id'] ?></td>
                    <td><?php echo $item['customer_name'] ?></td>
                    <td><?php echo $item['ddate'] ?></td>
                    <td><?php echo $item['item_name'] ?></td>
                    <td><?php echo $item['qty'] ?></td>
                    <td><?php echo $item['price'] ?></td>
                    <td><?php echo $item['accepted'] ? 'Accepted' : 'Rejected' ?></td>
                    <td><a href="accept-order?id=<?= $item['id'] ?>">Accept</a><a href="reject-order?id=<?= $item['id'] ?>">Reject</a></td>
                    <td>
                        <form action="assign-driver" method="POST">
                            <input type="text" hidden name="id" value="<?= $item['id'] ?>">
                            <select name="driver" id="drivers">
                                <option value="" disabled selected hidden>Select a Driver</option>
                                <?php foreach ($drivers as $driver) { ?>
                                    <option value="<?= $driver['id'] ?>"><?= $driver['username'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="submit" name="Submit" value="Assign">
                        </form>
                    </td>

                </tr>
            <?php }

            ?>

        </table>
    </div>

</body>

</html>