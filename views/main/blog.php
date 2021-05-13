<!DOCTYPE html>
<html>
<head>
	<title>Kamu.lk | Blog</title>

	<link rel="stylesheet" href="../assets/css/main/style.css">
	<link rel="stylesheet" href="../assets/css/nutritionist/post.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
	<body>
        <div class="container"> 
            <div class="navbar">
                <div class="logo">
                    <img class="logo" src="../assets/images/logo.png" alt="logo" width="150px">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index">Home</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="restaurant">Restaurants</a></li>
                        <li><a href="about-us">About Us</a></li>
                        <li><a href="../auth/login" class="btn">Login</a></li>
                    </ul>
                </nav>
                <img src="../assets/images/menu.png" class="menu-icon" alt="menu" onclick="menutoggle()">
			</div>
			</div>
			
			<h1 style="position: relative; left:30px;">Kamu.lk Food Library</h1><br><br>
            <?php foreach($posts as $post) { ?>

			<table style="width:1350px; position:relative; top:20px; left:30px;">

			<tr>
			<td colspan="3" rowspan="5"> <img style="width: 450px; border-radius:15px;" src="<?php echo "../" . $post['image'] ?>" alt="post image"></td>
			<td  style="position: relative; left:30px;"><h2><?php echo $post['title']; ?></h2></td>
			<td colspan="2" style="position: relative; left:30px;"><h2>Author:- <?php echo $post['username']; ?></h2></td>
			</tr>
			<tr>
			<td colspan="3" rowspan="4"style="position: relative; left:30px;"><p><?php echo $post['description']; ?></p></td>
			</tr>
			</table><br><br>
                <?php } ?>
	</body>
</html>