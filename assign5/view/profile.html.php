<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

$user = new User( $_REQUEST["username"]);
$details = $user->getDetails();

if ( $details == false) {
	$_SESSION["flashError"] = "Could not get details. Try again";
	header( 'Location: ../view/index.html.php');
}

if ( $details["permission"] == 3) {
	$user = new Admin( $_REQUEST["username"]);
}
else {
	$user = new Blogger( $_REQUEST["username"], $details["userType"]);
}
$user->getDetails();

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
			<h2><?php echo $details["firstName"] . " " . $details["lastName"]; ?></h2>
		</div>

		<div class="row">
			<div class="col">
				<p><?php echo $details["username"]; ?></p>
			</div>

			<div class="col">
				<p><?php echo $details["birthDate"]; ?></p>
			</div>
		</div>

		<div class="row">
			<p><?php echo $details["email"]; ?></p>
		</div>

		<div class="row">
			<pre><?php echo $details["bio"]; ?></pre>
		</div>

		<!-- check if user has verified the email -->
		<?php 
		if ( $_SESSION["user"]->getUsername() == $details["username"]) {
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
				echo "Hey verified user";
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

</body>
</html>

