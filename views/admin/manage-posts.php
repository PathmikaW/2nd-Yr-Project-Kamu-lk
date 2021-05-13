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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin/adminstyle.css">
</head>

<body>
    <div class="admin-dashboard">
        <?php include('nav.php'); ?>
        <h1 style="position: relative; left:30px;">Kamu.lk Food Library</h1><br><br>
        <?php foreach($posts as $post) { ?>

        <?php foreach($author as $authors) { ?>

        <table style="width:1100px; position:relative; top:40px; left:280px; background-color:white; color:black;">
            <tr>
                <td colspan="7"></td>
                <td>
                    <form action="post-delete?id=<?php echo $post ['post_id'];?>" method="POST">
                        <input style="background-color:#f44336;" type="submit" name="delete" value="Delete" id="delete">
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="5"> <img style="width: 450px; border-radius:15px;"
                        src="<?php echo "../" . $post['image'] ?>" alt="post image"></td>
                <td style="position: relative; left:30px;">
                    <h2><?php echo $post['title']; ?></h2>
                </td>
                <td colspan="2" style="position: relative; left:30px;">
                    <h2>Author:- <?php echo $authors['username']; ?></h2>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="4" style="position: relative; left:30px;">
                    <p><?php echo $post['description']; ?></p>
                </td>
            </tr>
        </table><br><br>
        <?php } ?>
        <?php } ?>


</body>

</html>