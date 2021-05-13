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
    <title>Seller Request</title>
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
                        <th colspan="10" style="background-color: #004359; color:white">
                            <h2>Seller Request</h2>
                        </th>
                    </tr>
                    <tr style="background-color: #004359; color:white">
                        <th>Restaurant Name</th>
                        <th>Restaurant Address</th>
                        <th>Seller Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach($users as $user) { ?>
                    <tr>

                        <td><?php echo $user['resname'];?></td>
                        <td><?php echo $user['resaddress'];?></td>
                        <td><?php echo $user['sellername'];?></td>
                        <td><?php echo $user['phonenumber'];?></td>
                        <td><?php echo $user['email'];?></td>
                        <td>
                            <form action="seller-accept?id=<?php echo $user ['id'];?>" method="POST">
                                <input type="submit" name="update" value="Accept" id="delete">
                            </form>

                        <td>
                            <form action="seller-delete?id=<?php echo $user ['id'];?>" method="POST">
                                <input type="submit" name="delete" value="Reject" id="delete">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
</body>

</html>