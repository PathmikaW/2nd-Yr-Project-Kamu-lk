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
    <title>User Dashboard</title>
</head>
<body>
    <div class="user-dashboard">
        <?php include('dash_include/nav.php'); ?>

		<h2 style="align-content: center;text-transform: capitalize;">My Posts</h2><br>
            <a href="add-post?id=<?php echo $_SESSION['loggedin']['user_id'];?>"><button class="button buttonc">Add Post </button></a><br><br>

            <div class="row">
            <?php foreach($posts as $post) { ?>
                <div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="<?php echo "../" . $post['image'] ?>" alt="post image">
                                <h2><?php echo $post['title']; ?></h2>
                                <p><?php echo $post['description']; ?></p>
                            </div>
                            <a href="update-post?id=<?= $post['post_id'] ?>"> <button class="button1">Update</button></a>
                            <form action="delete-post?id=<?php echo $post ['post_id'];?>" method="POST">
                                <input type="submit" name="delete" value="Delete" class="button1">
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

        
</body>
</html>

