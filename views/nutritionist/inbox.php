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
    <title>Kamu Nutritionist | Inbox</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/food.css">
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="card">
            <div class="food-view">
                <h2 style="text-align: left;">Client Messages</h2><br>
                <table id="food">
                    <tr>
                        <th></th>
                        <th>From</th>
                        <th>Subject</th>
                        <th >Action</th>
                    </tr>
                    <?php foreach($unreads as $unread) { ?>
                    <tr>
                        <td><i class="fa fa-envelope" style="font-size: 20px;"></i></td>
                        <td><?php echo $unread['email'];?></td>
                        <td><?php echo $unread['subject'];?></td>
                        <td><a href="send-reply?id=<?php echo $unread['inbox_id'];?>"> <button class="button1">Reply</button></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div> 
        <br>
        <div class="card">
            <div class="food-view">
                <h2 style="text-align: left;">My Messages</h2><br>
                <table id="food">
                    <tr>
                        <th></th>
                        <th>From</th>
                        <th>Subject</th>
                        <th >Action</th>
                    </tr>
                    <?php foreach($replys as $reply) { ?>
                    <tr>
                        <td><i class="fa fa-envelope" style="font-size: 20px;"></i></td>
                        <td><?php echo $reply['email'];?></td>
                        <td><?php echo $reply['subject'];?></td>
                        <td><a href="send-reply?id=<?php echo $reply['inbox_id'];?>"> <button class="button1">View</button></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div> 
        <br>
        <div class="card">
            <div class="food-view">
                <h2 style="text-align: left;">Sent Messages</h2><br>
                <table id="food">
                    <tr>
                        <th></th>
                        <th>To</th>
                        <th>Subject</th>
                        <th >Action</th>
                    </tr>
                    <?php foreach($sents as $sent) { ?>
                    <tr>
                        <td><i class="fa fa-envelope-open" style="font-size: 20px;"></i></td>
                        <td><?php echo $sent['email'];?></td>
                        <td><?php echo $sent['subject'];?></td>
                        <td><a href="mealplan_form.php"> <button class="button1">View</button></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div> 
    </div>
</body>
</html>