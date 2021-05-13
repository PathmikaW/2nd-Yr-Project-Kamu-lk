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
    <title>Kamu Nutritionist | View Food</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/food.css">
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-view">
            <h2 style="align-content: center;text-transform: capitalize;">Food Details in 100g </h2><br>
            <a href="food-add"><button class="button buttonc">Add New Food </button></a><br><br>
            
            <table id="food">
                <tr>
                    <th>Food name</th>
                    <th>Calories(kcal)</th>
                    <th>Protein(g)</th>
                    <th>Fat(g)</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php foreach($foods as $food) { ?>
                <tr>
                    <td><?php echo $food['foodName'];?></td>
                    <td><?php echo $food['calories'];?></td>
                    <td><?php echo $food['protein'];?></td>
                    <td><?php echo $food['fat'];?></td>
                    <td> <a href="food-update?id=<?php echo $food ['id'];?>"> <button class="button1">Update</button></a></td>
                    <td> 
                        <form action="food-delete?id=<?php echo $food ['id'];?>" method="POST">
                            <input type="submit" name="delete" value="Delete" class="button1">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>