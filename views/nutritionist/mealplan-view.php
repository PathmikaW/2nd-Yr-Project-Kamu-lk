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
    <title>Kamu Nutritionist | View MealPlan</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/food.css">
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-view">
            <a href="sent-list"><button class="button buttonc">Sent List</button></a><br><br>
            <h2 style="align-content: center;text-transform: capitalize;">Client Details </h2><br>
            <table id="food">
                <tr>
                    <th>Client name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Height(m)</th>
                    <th>Weight(kg)</th>
                    <th>BMI</th>
                    <th>Physical Exercise level</th>
                    <th>Diet Preference</th>
                    <th>Special notes</th>
                </tr>
                <tr>
                    <td><?php echo $name;?></td>
                    <td><?php echo $age;?></td>
                    <td><?php echo $gender;?></td>
                    <td><?php echo $height;?></td>
                    <td><?php echo $weight;?></td>
                    <td><?php echo $bmi;?></td>
                    <td><?php echo $activity_level;?></td>
                    <td><?php echo $preference;?></td>
                    <td><?php echo $notes;?></td>
                </tr>
            </table>
        </div>
        <br><br>
        <div class="card">
            <div class="food-view">
            <h2 style="text-align: left;">Meal Plan Details </h2><br>
                <table id="food">
                    <tr>
                        <th>Meal Type</th>
                        <th>Food</th>
                        <th>Quantity(g)</th>
                    </tr>
                    <?php foreach($viewplans as $viewplan) { ?>
                    <tr>
                        <td><?php echo $viewplan['meal_type'];?></td>
                        <td><?php echo $viewplan['food'];?></td>
                        <td><?php echo $viewplan['quantity'];?></td>
                    </tr>
                    <?php } ?>
                </table><br>
                <form action="mealplan-delete?id=<?php echo $request_id;?>" method="POST">
                    <input type="submit" name="delete" value="Delete" class="button">
                </form>
            </div> 
        </div>
        
    </div>
</body>
</html>