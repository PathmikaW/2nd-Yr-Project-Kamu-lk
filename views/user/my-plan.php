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
    <title>Kamu Nutritionist | Request List</title>
    <link rel="stylesheet" href="../assets/css/user/table.css">
    <link rel="stylesheet" href="../assets/css/user/dash.css">
</head>

<div class="user-dashboard">
    <?php include('dash_include/nav.php'); ?>
    <table class="form-container">
	<thead>
		<tr>
            <th>Special Note</th>
            <th colspan="2">Actions</th>
		</tr> 
	</thead>
	<tr>
        <?php foreach($myplans as $myplan) { ?>
		<td><?php echo $myplan['specialNotes'];?></td>
        <td> <a href="view-mealplan?id=<?php echo $myplan['request_id'];?>"> <button class="button1">View</button></a></td>
        <td> 
            <form action="delete-mealplan?id=<?php echo $myplan['request_id'];?>" method="POST">
                <input type="submit" name="delete" value="Delete" class="button1">
            </form>
        </td>
	</tr>	
	<?php } ?>
</table>
</body>
</html>