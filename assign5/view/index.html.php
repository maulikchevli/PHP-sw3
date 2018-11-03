<?php

require_once '../model/User.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

?>

<!DOCTYPE html>
<html land="en">
<head>
	<title>NITx-Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	
	<!-- custom css -->
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	<header class="container-fluid sticky-top">
		<?php require 'header.html.php' ?>
	</header>

	<main class="container">
		<?php
			$viewer = new User( 'viewer');

			$blogs = $viewer->getBlogs();
			
			if ( $blogs == false) {
				echo "could not display" . "<br>";
				echo $viewer->getError();
			}
			else {
				while ( $blog = $blogs->fetch_assoc()) {
					$likeDB = $viewer->getLikes( $blog["blogId"]);
					$commentDB = $viewer->getComments( $blog["blogId"]);

					$numLikes = $likeDB->num_rows;
					$numComments = $commentDB->num_rows;
				?>
					<div class="row">
						<!-- Blog Post -->
						<div class="col-lg-8">
							<!-- Title -->
							<h1><a href="../view/blog.html.php?blogId=<?php echo $blog['blogId']; ?>"><?php echo $blog['title'];?></a></h1>

							<!-- Author -->
							<p class="lead">
								by <a class="col" href="../view/profile.html.php?username=<?php echo $blog["owner"];?>"><?php echo $blog['owner'];?></a>
								<span class="col glyphicon glyphicon-time"></span> Posted on <?php echo $blog['time'];?>
							</p>
							<hr>
							<!-- Body -->
							<pre><?php echo $blog['body'];?></pre>

							<hr>
							<p>Likes: <span class="badge"><?php echo $numLikes; ?></span></p>
							<p>Comments: <span class="badge"><?php echo $numComments; ?></span></p>
						</div>
						<hr>
					</div>
				<?php
				}
			}
		?>
		<!-- Blogs -->
	</main>

	<footer class="page-footer">
		<?php require_once 'footer.html.php'; ?>
	</footer>

</body>
</html>

