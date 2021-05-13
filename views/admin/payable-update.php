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
    <title>Update Payable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/to-do.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/adminstyle-responsive.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/forms.css">
</head>

<body>
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <div class="content">
            <div class="user-form form-container">
                <form class="form" action="../admin/payable-update?id=<?php echo $id;?>" method="post"
                    style="position:relative; top:120px; left:340px;">
                    <h2 style="text-transform: capitalize; color:black;">Update Transaction Details</h2><br>
                    <div class="form-group">

                        <label>Date</label>
                        <input class="form-control" type="date" name="date" size="10" value="<?php echo $date;?>"
                            autocomplete="off" required /><br>

                        <label for="payment_type">Transaction Type:</label>
                        <input class="form-control" type="text" name="date" size="10"
                            value="<?php echo $payment_type;?>" autocomplete="off" required /><br>
                        <!--<select name="payment_type" id="payment_type">
                        <option value="<?php //echo $payment_type;?>">Payable</option>
                        <option value="<?php //echo $payment_type;?>">Recievable</option>
                        </select><br><br>-->

                        <label>Amount</label>
                        <input class="form-control" type="text" name="username" size="10" autocomplete="off"
                            value="<?php echo $amount;?>" required /><br>

                        <label for="status">Status:</label>
                        <input class="form-control" type="text" name="date" size="10" value="<?php echo $status;?>"
                            autocomplete="off" required /><br>
                        <!--<option value="<?php //echo $status;?>">Paid</option>
                        <option value="<?php //echo $status;?>">Not Paid</option>
                        </select>-->
                    </div>
                    <input class="button" type="submit" name='submit2' value="Update" size="25">

                </form>
            </div>
        </div>
</body>

</html>