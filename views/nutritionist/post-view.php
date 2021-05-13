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
    <title>Kamu Nutritionist | View Post</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/post.css">

</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-view">
            <h2 style="align-content: center;text-transform: capitalize;">My Posts</h2><br>
            <a href="post-add?id=<?php echo $_SESSION['loggedin']['user_id'];?>"><button class="button buttonc">Add Post </button></a><br><br>
            <div class="row">
            <?php foreach($posts as $post) { ?>
                <div class="col-2">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo "../" . $post['image'] ?>" alt="post image">
                            <h2><?php echo $post['title']; ?></h2>
                            <p><?php echo $post['description']; ?></p></a>
                        </div>
                        <a href="post-update?id=<?= $post['post_id'] ?>"> <button class="button1">Update</button></a>
                        <form action="post-delete?id=<?php echo $post ['post_id'];?>" method="POST">
                            <input type="submit" name="delete" value="Delete" class="button1">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>     
        </div>
    </div>
</body>
</html>