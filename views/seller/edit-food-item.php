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
    <link rel="stylesheet" href="../assets/css/seller/formsmenu.css">

    <title>Edit Food Items</title>

</head>

<body>
    <div class="seller-dashboard">
        <?php include('dash-include/edit_food_item_nav.php'); ?>
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

    <div class="contaier">
        <form action="edit-food-item?id=<?= $data['id'] ?>" method='post' enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name=user_id value="<?php echo $_SESSION['loggedin']['user_id']; ?>">
                <div class="col-25">
                    <label>Food Name</label>
                </div>
                <div class="col-75">
                    <input type="text" autocomplete="off" name="foodName" value="<?= $data['item_name'] ?>" class="form-control" placeholder="Enter Item Name">
                    <!-- <div><?= $_SESSION['edit_menu_item']['item_name'] ?></div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label>Description</label>
                </div>
                <div class="col-75">
                    <input type="text" autocomplete="off" name="description" value="<?= $data['description'] ?>" class="form-control form-control-danger" placeholder="Description">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label>Price </label>
                </div>
                <div class="col-75">
                    <input type="text" name="price" value="<?= $data['price'] ?>" class="form-control" placeholder="LKR ">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label>Image</label>
                    <img width="100px" height="100px" src="<?= "../" . $data['image'] ?>" alt="">
                </div>
                <div class="col-75">
                    <input type="file" name="fileToUpload" id="lastName" class="form-control form-control-danger" placeholder="12n">
                </div>
            </div>


            <div class="row">
                <div class="col-715">
                    <input type="submit" name="submit" class="btn-success" value="Update">

                    <div class="col-716">
                        <a href="add-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>" class="btn-inverse"><button type="reset" value="Reset" class="btn-inverse">Cancel</button></a><br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-715">
                    <a href="view-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>"><button type="button" class="button">View Items</button></a>
                </div>
            </div>
        </form>

    </div>
</body>

</html>