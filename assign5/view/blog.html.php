<?php

require_once '../model/User.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

// allow only signed up users to view this page
@session_start();
if ( !isset( $_SESSION["user"])) {
	$_SESSION["flashError"] = "Login to view the blog";
	header( 'Location: ../view/login.html.php');
}

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
		$blog = new Blog("","","",$_REQUEST["blogId"]);
		$numLikes = $blog->getLikeDB()->num_rows;
		$numComments = $blog->getCommentDB()->num_rows;

		$likeStatus = $blog->isLiker( $_SESSION["user"]->getUsername());
		if ( $likeStatus) {
			$likeStatus = "unlike";
		} else {
			$likeStatus = "like";
		}
		?>
			<div class="row">
				<!-- Blog Post -->
				<div class="col-12 jumbotron">
					<!-- Title -->
					<h1><?php echo $blog->getTitle(); ?></h1>
					<!-- Author -->
					<p class="lead">
						by <a class="col" href="../view/profile.html.php?username=<?php echo $blog->getOwner(); ?>"><?php echo $blog->getOwner(); ?></a>
						<span class="col glyphicon glyphicon-time"></span> Posted on <?php echo $blog->getTimeOfPost(); ?>
					</p>
					<hr>
					<!-- Body -->
					<p><?php echo $blog->getBody(); ?></p>

					<hr>
					<p>
						Likes: <span class="badge"><?php echo $numLikes; ?></span>
						<a href="../action/<?php echo $likeStatus;?>Blog.php?blogId=<?php echo $_REQUEST['blogId']; ?>"><?php echo $likeStatus; ?></a>
					</p>

					<p>Comments: <span class="badge"><?php echo $numComments; ?></span></p>
				</div>
			<div>

			<div class="row">
				<!-- Post a comment -->
				<form class="form-row" method="post" action="../action/comment.php?blogId=<?php echo $blog->getBlogId(); ?>">
					<label for="comment">Comment on post:</label>
					<input type="text" id="comment" name="comment" class="form-control">
					<button type="submit" class="btn btn-outline-primary">Comment</button>
				</form>
			</div>

			<hr>

			<div class="row">
				<?php
				$commentsInfo = $blog->getCommentDB();

				while( $comment = $commentsInfo->fetch_assoc()) {
				?>
					<div class="col-sm-3">
						<a href="../view/profile.html.php?username=<?php echo $comment["username"]; ?>"><?php echo $comment["username"]; ?></a>
					</div>
					
					<div class="col-sm-9">
						<?php echo $comment["comment"]; ?>
					</div>
				<?php
				}
				?>
			</div>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>
