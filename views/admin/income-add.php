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
    <title>Income Add</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/forms.css">
</head>

<body>
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <div class="content">
            <div class="user-form form-container">
                <form class="form" action="../admin/income-add" method="post"
                    style="position:relative; top:120px; left:340px;">
                    <h2 style="text-transform: capitalize; color:black">Add Transaction Details</h2><br>
                    <div class="form-group">
                        <label>Order Id</label>
                        <input class="form-control" type="text" name="order_id" size="10" autocomplete="off"
                            placeholder="Enter Order ID" required /><br>

                        <label>User Id</label>
                        <input class="form-control" type="text" name="user_id" size="10" autocomplete="off"
                            placeholder="Enter User ID" required /><br>

                        <label>Date</label>
                        <input class="form-control" type="date" name="date" size="10" autocomplete="off" required><br>

                        <label for="payment_type">Transaction Type:</label>
                        <select name="payment_type" id="payment_type">
                            <option value="payable">Payable</option>
                            <option value="recievable">Recievable</option>
                        </select><br><br>

                        <label>Amount</label>
                        <input class="form-control" type="text" name="amount" size="10" value=""
                            placeholder="Enter the total amount in LKR" autocomplete="off" required><br>

                        <label for="status">Status:</label>
                        <select name="status" id="status">
                            <option value="paid">Paid</option>
                            <option value="not_paid">Not Paid</option>
                        </select>
                    </div>
                    <span class="invalidFeedback">
                        <?php echo $Error;?>
                    </span>
                    <input class="button" type="submit" name='submit2' value="Submit" size="25">
                    <input class="button" type="reset" value="Reset" size="25">
                </form>
            </div>
        </div>
</body>

</html>