<?php 
require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

?>
<!DOCTYPE html>
<html land="en">
<head>
	<title>NITx-VerifyMe</title>
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
		$details = $_SESSION["user"]->getDetails();

		if ( $details["emailVerified"] == 0 ) {
			$_SESSION["flashError"] = "Verify your email first";
			header( 'Location: ../view/profile.html.php?username='.$details["username"]);
		}
		?>

		<h1>Details</h1>
		<p>Provide all the details so that admin can verify you</p>
		<form method="post" action="../action/verifyRequest.php">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username">

				<label for="phoneNum">Phone Number</label>
				<input type="number" class="form-control" id="phoneNum" name="phoneNum">

				<label for="gender">Gender</label>
				<input type="radio" class="form-control" id="gender" name="gender">
			</div>

			<button type="submit" class="btn btn-outline-success">Submit</button>
		</form>
	</main>

	<footer class="footer">
		<?php require_once 'footer.html.php'; ?>
	</footer>

</body>
</html>

