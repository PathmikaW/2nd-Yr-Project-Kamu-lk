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
    <title>Kamu Nutritionist | Add MealPlan</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/mealForm.css"> 
    <link rel="stylesheet" href="../assets/css/nutritionist/forms.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/food.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var html = '';
            html += '<tr>';
            html += '<td><select name="meal_type[]" id="meal_type" class="form-control"><option value="breakfast">Breakfast</option>';
            html +=' <option value="lunch">Lunch</option><option value="dinner">Dinner</option><option value="snacks">Snacks</option></select></td>';
            html += '<td><select name="food[]" id="food" class="form-control"><?php foreach($foods as $food) { ?>';
            html += '<option value="<?php echo $food['foodName'];?>"><?php echo $food['foodName'];?></option><?php } ?></select> </td>';
            html += '<td><input class="form-control" type="number" name="quantity[]" size="10" value="" autocomplete="off"  required></td>'; 
            html += ' <td><input class="button1" type="button" name="remove" id="remove" value="&#8722;"></td></tr>"';

            var x = 1;

            $("#add").click(function(){
                $("#food1").append(html);
            });

            $("#food1").on('click','#remove',function(){
                $(this).closest('tr').remove();
            });

        });
    </script>
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-view">
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
            <br><br>
            <a style="float:right;" href="food-add"><button class="button buttonc">Add New Food </button></a><br><br>
            <h2 style="align-content: center;text-transform: capitalize;">Meal Plan Details </h2><br>
            <form  action="../nutritionist/mealplan-add?id=<?php echo $request_id;?>" method="post">
                <table id="food1">
                    <tr>
                        <th>Meal</th>
                        <th>Food</th>
                        <th>Quantity(g)</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>                         
                            <select name="meal_type[]" id="meal_type" class="form-control">
                                <option value="breakfast">Breakfast</option>
                                <option value="lunch">Lunch</option>
                                <option value="dinner">Dinner</option>
                                <option value="snacks">Snacks</option>
                            </select>
                        </td>
                        <td>
                            <select name="food[]" id="food" class="form-control">
                            <?php foreach($foods as $food) { ?>
                                <option value="<?php echo $food['foodName'];?>"><?php echo $food['foodName'];?></option>
                                <?php } ?>
                            </select> 
                        </td>
                        <td>
                            <input class="form-control" type="number" name="quantity[]" size="10" value="" autocomplete="off"  required>  
                        </td>
                        <td>
                            <input class="button1" type="button" name="add" id="add" value="&#43;">
                        </td>
                    </tr>
                   
                </table><br>
                <label>Special Note</label>
                        <input class="form-control" type="text" name="specialNote" size="50"
                            value="" autocomplete="off" placeholder="Enter special note here" required><br>
                <input class="button" type="submit" name='submit' value="submit" size="25">
            </form>
           
        </div>           
    </div>
</body>
</html>