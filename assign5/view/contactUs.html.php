<?php 
require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';
?>
<!DOCTYPE html>
<html land="en">
<head>
	<title>NITx-ContactUs</title>
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
		<h1>Contact Us</h1>
		<form method="post" action="../action/login.php">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Username">
			</div>

			<button type="submit" class="btn btn-outline-success">Login</button>
		</form>
	</main>

	<footer class="footer">
		<?php require_once 'footer.html.php'; ?>
	</footer>

</body>
</html>

