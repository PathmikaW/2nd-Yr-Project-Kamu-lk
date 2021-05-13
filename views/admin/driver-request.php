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
    <title>Driver Request</title>
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
                            <h2>Driver Request</h2>
                        </th>
                    </tr>
                    <tr style="background-color: #004359; color:white">
                        <th>Driver Name</th>
                        <th>NIC</th>
                        <th>License</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach($users as $user) { ?>
                    <tr>

                        <td><?php echo $user['drivername'];?></td>
                        <td><?php echo $user['nic'];?></td>
                        <td><?php echo $user['license'];?></td>
                        <td><?php echo $user['contact'];?></td>
                        <td><?php echo $user['email'];?></td>
                        <td><form action="driver-accept?id=<?php echo $user ['id'];?>" method="POST">
                                <input type="submit" name="update" value="Accept" id="delete">
                            </form>

                        <td>
                            <form action="driver-delete?id=<?php echo $user ['id'];?>" method="POST">
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