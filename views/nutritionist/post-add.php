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
    <title>Kamu Nutritionist | Add Post</title>
    <link rel="stylesheet" href="../assets/css/nutritionist/style.css">
    <link rel="stylesheet" href="../assets/css/nutritionist/foodForm.css"> 
    <link rel="stylesheet" href="../assets/css/nutritionist/forms.css">
</head>

<body>
<?php include('nav.php'); ?>
    <div class="content">
        <div class="food-form form-container">
            <h2 style="text-transform: capitalize;">Add Post</h2><br>
            <form class="form" action="../nutritionist/post-add?id=<?php echo $_SESSION['loggedin']['user_id'];?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                        <input class="form-control" type="text" name="title" size="50"
                            value="" autocomplete="off" placeholder="Enter Your Name Here" required><br>
                    <label>Image</label>
                        <input class="form-control" type="file"  name="fileToUpload" size="50"
                            value="" placeholder="Enter Image"><br>
                    <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="Description" 
                            style="display: block; border: 2px solid #ccc; width: 95%; padding: 6px; margin: 5px auto;border-radius: 5px;" required></textarea><br>                        
                </div>
                <input class="button" type="submit" name='submit2' value="submit" size="25">
                <input class="button" type="reset" value="reset" size="25">
            </form>
        </div>
    </div>
</body>
</html>