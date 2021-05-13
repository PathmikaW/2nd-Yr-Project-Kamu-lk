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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/user/form.css">
    <link rel="stylesheet" href="../assets/css/user/dash.css">
    <title>Request Meal Plan</title>
</head>
<body>
<div class="user-dashboard">
    <?php include('dash_include/nav.php'); ?>
    <div class="content">
        <div class="food-form form-container">
            <h2 style="text-transform: capitalize;">Request Mealplan Form</h2><br>
            <form class="form" action="../user/request-meal-plan?id=<?php echo $_SESSION['loggedin']['user_id'];?>" method="post">
                <div class="form-group">
                    <label>Gender</label><br>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select><br>
                    <label>Age</label>
                        <input class="form-control" type="number" name="age" step=1 value="<?php echo $age;?>" placeholder="Enter your age" autocomplete="off" required><br> 
                    <label>Height(m)</label>                                        
                        <input class="form-control" type="number" step="0.01" min=0 name="height" value="<?php echo $height;?>" placeholder="Enter your height in meters" autocomplete="off" required><br>
                    <label>Weight(kg)</label>                                        
                        <input class="form-control" type="number" name="weight" value="<?php echo $weight;?>" placeholder="Enter your weight in meters" autocomplete="off" required><br>
                    <label>Activity level</label>
                        <select name="activity_level" id="activity_level" class="form-control">
                            <option value="lightly">Lightly Active</option>
                            <option value="moderate">Moderate Active</option>
                            <option value="very">Very Active</option>
                            <option value="extremely">Extremely Active</option>
                        </select><br>
                    <label>Diet Preference</label><br>
                        <select name="preference" id="preference" class="form-control">
                            <option value="anything">Anything</option>
                            <option value="paleo">Paleo</option>
                            <option value="vegetarian">Vegetarian</option>
                            <option value="vegan">Vegan</option>
                        </select><br>
                    <label>Special Note</label><br>
                        <textarea name="note" placeholder="Enter special note.Ex: Drugs you get.etc" rows="3" class="form-control" required></textarea><br>                           
                </div>
                <input class="button" type="submit" name='submit2' value="Request" size="25">
                <input class="button" type="reset" value="reset" size="25">
            </form>
        </div>
    </div>
</div>
</body>
</html>
