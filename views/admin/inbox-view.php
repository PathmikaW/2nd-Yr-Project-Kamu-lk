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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inbox View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
</head>

<body>
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <div class="content" style="position:relative; top:120px; left:340px;">
            <div class="tableview">
                <table class="table" style="position:relative; top:10px; left: -90px;">
                    <tr>
                        <th colspan="6" style="background-color:#004359; color:white">
                            <h2>Recieved Messages</h2>
                        </th>
                    </tr>
                    <tr style="background-color: #004359; color:white">
                        <th>Inbox_ID</th>
                        <th>&#8287 From &#8287</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach($recieve as $recieves) { ?>
                    <tr>
                        <td><?php echo $recieves['inbox_id'];?></td>
                        <td><?php echo $recieves['from_id'];?></td>
                        <td><?php echo $recieves['subject'];?></td>
                        <td><?php echo $recieves['message'];?></td>

                        <td><a href="reply-add?id=<?php echo $recieves ['inbox_id'];?>">
                                <button id="update">Reply</button></a></td>
                        <td>
                            <form action="unread-delete?id=<?php echo $recieves ['inbox_id'];?>" method="POST">
                                <input type="submit" name="delete" value="Delete" id="delete">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table> <br><br><br>
            </div>
            <div class="tableview">
                <table class="table" style="position:relative; top:10px; left: -90px;">
                    <tr>
                        <th colspan="6" style="background-color:#004359; color:white">
                            <h2>Sent Messages</h2>
                        </th>
                    </tr>
                    <tr style="background-color: #004359; color:white">
                        <th>Inbox_ID</th>
                        <th>&#8287 To &#8287</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach($sents as $sent) { ?>
                    <tr>
                        <td><?php echo $sent['inbox_id'];?></td>
                        <td><?php echo $sent['from_id'];?></td>
                        <td><?php echo $sent['subject'];?></td>
                        <td><?php echo $sent['message'];?></td>
                        <td>
                            <form action="sent-delete?id=<?php echo $sent ['inbox_id'];?>" method="POST">
                                <input type="submit" name="delete" value="Delete" id="delete">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table><br><br><br>
            </div>
            <div class="tableview">
                <table class="table" style="position:relative; top:10px; left: -90px;">
                    <tr>
                        <th colspan="6" style="background-color:#004359; color:white">
                            <h2>Replies</h2>
                        </th>
                    </tr>
                    <tr style="background-color: #004359; color:white">
                        <th>Inbox_ID</th>
                        <th>&#8287 From &#8287</th>
                        <th>Subject</th>
                        <th>Reply</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach($reply as $replies) { ?>
                    <tr>
                        <td><?php echo $replies['inbox_id'];?></td>
                        <td><?php echo $replies['from_id'];?></td>
                        <td><?php echo $replies['subject'];?></td>
                        <td><?php echo $replies['reply'];?></td>
                        <td>
                            <form action="reply-delete?id=<?php echo $replies ['reply_id'];?>" method="POST">
                                <input type="submit" name="delete" value="Delete" id="delete">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
</body>

</html>