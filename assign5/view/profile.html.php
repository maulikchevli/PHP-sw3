<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

$user = new User( $_REQUEST["username"]);
$details = $user->getDetails();

@session_start();

if ( $details == false) {
	$_SESSION["flashError"] = "Could not get details. Try again";
	header( 'Location: ../view/index.html.php');
}

if ( $details["userType"] == 3) {
	$user = new Admin( $_REQUEST["username"]);
}
else {
	$user = new Blogger( $_REQUEST["username"], $details["userType"]);
}
$user->getDetails();

// check condition if its not an admin
$followerDB = $user->getFollowers();
$followingDB = $user->getFollowings();

$numOfFollowers = $followerDB->num_rows;
$numOfFollowings = $followingDB->num_rows;

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
		<div class="row">
			<div class="col">
				<h1><?php echo $details["firstName"] . " " . $details["lastName"]; ?></h1>
			</div>

			<div class="col">
				<button class="btn btn-primary">
					Followers <span class="badge"><?php echo $numOfFollowers;?></span>
				</button>
				
				<button class="btn btn-primary">
					Following <span class="badge"><?php echo $numOfFollowings;?></span>
				</button>
			</div>
		</div>

		<div class="row">
			<!-- Follow unfllow -->
			<?php 
			if ( isset( $_SESSION["user"])) {
				if ( $_SESSION["user"]->getUsername() != $details["username"]) {
					$myFollowingDB = $_SESSION["user"]->getFollowings();
					$myFollowingBD = $_SESSION["user"]->getFollowers();
					
					$isFollowing = false;
					while( $following = $myFollowingDB->fetch_assoc()) {
						if ( $following["username"] == $details["username"]) {
							$isFollowing = true;
							break;
						}
					}

					if ( $isFollowing) {
					?>
						<a href="../action/unfollow.php?username=<?php echo $details["username"];?>">Unfollow</a>
					<?php
					} else {
					?>
						<a href="../action/follow.php?username=<?php echo $details["username"];?>">Follow</a>
					<?php
					}
				}
			}
			?>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<p>Username : <?php echo $details["username"]; ?></p>
			</div>

			<div class="col-sm-2">
				<p><?php echo $details["birthDate"]; ?></p>
			</div>

			<div class="col-sm-4">
				<p><?php echo $details["email"]; ?></p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-2">
				Bio :
			</div>

			<div class="col-sm-6">
				<pre><?php echo $details["bio"]; ?></pre>
			</div>
		</div>

		<!-- check if user has verified the email -->
		<?php 
		if ( isset( $_SESSION["user"]) ) {
				$viewer = $_SESSION["user"];
				$blogs = $viewer->getBlogsDetails( $details["username"]);

			if( $_SESSION["user"]->getUsername() == $details["username"]) {
				if ( $_SESSION["user"]->isEmailVerified() == false) {
				?>

				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					Verify your email to write your blogs
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<?php
				}
				else {
					echo "email verified";
				}
			}
		}
		else {
			$viewer = new User( 'viewer');
			$blogs = $viewer->getBlogsDetails( $details["username"]);
		}
			
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
						<p><?php echo $blog['body'];?></p>

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

		<!-- Blog here -->
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

<script src=""></script>
</body>
</html>

