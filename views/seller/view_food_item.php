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
    <link rel="stylesheet" href="../assets/css/seller/formsmenu.css">

    <title>View Food Items</title>
    <style>

    </style>
</head>

<body>
    <div class="seller-dashboard">
        <?php include('dash-include/view_food_item_nav.php'); ?>
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
        <div table>

            <table id="fooditems">
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Vegetarin Status</th>
                    <th>Image</th>
                </tr>
                <?php foreach ($data as $item) { ?>
                    <tr>
                    
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['item_name'] ?></td>
                        <td width=500px><?php echo $item['description'] ?></td>
                        <td><?php echo "Rs. ", $item['price'] ?></td>
                        <td><?php echo $item['vegetarian'] ?></td>
                        
                        <td><img width="50px" height="50px" src="<?php echo "../" . $item['image'] ?>" /></td>
                        <td> <a href="edit-food-item?id=<?= $item['id'] ?>"><button type="button" class="button4">Edit</button></a></td><br>
                        <td><form action="delete-food-item?id=<?= $item['id'] ?>" method="POST">
                                <input type="submit" name="delete" value="Delete" >
                                <input type="hidden" name=user_id value="<?php echo $_SESSION['loggedin']['user_id']; ?>">
                            </form></td>
                   
                    </tr>
                <?php }

                ?>
                <tr>
                    <td colspan="6" ><center><a href="add-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>"><button type="button" class="button2">Add Food Items</center></button></a></td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>