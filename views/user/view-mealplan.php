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
    <link rel="stylesheet" href="../assets/css/user/table.css">
    <link rel="stylesheet" href="../assets/css/user/dash.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="user-dashboard">
        <?php include('dash_include/nav.php'); ?>
        <table class="form-container">
	        <thead>
		        <tr>
		            <th>Meal Type</th>
		            <th>Foode</th>
		            <th>Quantity(g)</th>
		        </tr> 
	        </thead>
	                <tr>
					<?php foreach($plans as $plan){ ?>
					    <td><?php echo $plan['meal_type']?></td>
					    <td><?php echo $plan['food']?></td>
					    <td><?php echo $plan['quantity']?> </td>
					</tr>	

					 <?php } ?>

		</table><br>
        <?php echo $plan['request_id'];?>
                <form action="delete-mealplan?id=<?php echo $plan['request_id'];?>" method="POST" >
                    <input type="submit" name="delete" value="Delete" class="button1" style="margin-left:50%;">
                </form>
        </div>
</body>
</html>

