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
    <title>User Dashboardr</title>
</head>
<body>
    <div class="user-dashboard">
        <?php include('dash_include/nav.php'); ?>

<table class="form-container">
	<thead>
		<tr>
		<th>Item ID</th>
		<th>Item Name</th>
		<th>Price</th>
		</tr>
	</thead>


	<tr>
					<?php foreach($orders as $order){ ?>
					<td><?php echo $order['item_id']?></td>
					<td><?php echo $order['item_name']?></td>
					<td><?php echo $order['price']?></td>
					
				
					</tr>	
					 <?php } ?>
		</table>

        
</body>
</html>

