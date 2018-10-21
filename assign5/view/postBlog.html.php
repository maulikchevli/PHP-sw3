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
		if ( $_SESSION["user"]->isEmailVerified()) {
		?>
			<h1>New post</h1>
			<form method="post" action="../action/postBlog.php">
				<div class="form-row">
					<label class="col-sm-2" for="title">Title :</label>
					<input type="text" class="col-sm-10 form-control" id="title" name="title" placeholder="Title" required autofocus>
				</div>

				<div class="form-row">
					<label class="col-sm-2" for="body">Post :</label>
					<textarea class="col-sm-10 form-control" rows="5" id="body" name="body" required placeholder="What's up?"></textarea>
				</div>

				<div class="form-row"> 
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-outline-primary">Submit</button>
						<button type="reset" class="btn btn-outline-warning">Reset</button>
					</div>
				</div>

			</form>
		<?php
		}
		else {
		?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				Verify your email to write your blogs
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php
		}
		?>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>

