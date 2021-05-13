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

    <title>Add Food Items</title>
</head>

<body>
    <div class="seller-dashboard">
        <?php include('dash-include/add_food_item_nav.php'); ?>
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
        <h2 style="text-align:center;background-color:black;color:white;font-family:courier;">Add Your Food</h2>

        <form action="add-food-item?id=<?php echo $_SESSION['loggedin']['user_id']; ?>" method='post' enctype="multipart/form-data">
            <div class="row">

                <div class="col-25">
                    <label>Food Name</label>
                </div>
                <div class="col-75">
                    <input type="text" autocomplete="off" name="foodName" class="form-control" placeholder="Enter Item Name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label>Description</label>
                </div>
                <div class="col-75">
                    <input type="text" autocomplete="off" name="description" class="form-control form-control-danger" placeholder="Description" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label>Price </label>
                </div>
                <div class="col-75">
                    <input type="text" name="price" class="form-control" placeholder="LKR " required>
                </div>
            </div>


            <div class="row">
                <div class="col-25">
                    <label>Vegetarian Status</label>
                </div>
                <div class="col-75">
                <select name="vtype">
                    <option value="Vegetarian"><b>Vegetarian</b></option>
                    <option value="Non Vegetarian"><b>Non Vegetarian</b></option>
                </select>
                </div>
            </div>



            <div class="row">
                <div class="col-25">
                    <label>Image</label>
                </div>
                <div class="col-75">
                    <input type="file" name="fileToUpload" id="lastName" class="form-control form-control-danger" placeholder="12n">
                </div>
            </div>


            <div class="row">
                <div class="col-715">
                    <input type="submit" name="submit" class="btn-success" value="Add">

                    <div class="col-716">
                        <a href="add-food-item" class="btn-inverse"><button type="reset" value="Reset" class="btn-inverse">Cancel</button></a><br>
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