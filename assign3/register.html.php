<?php
require_once 'model/user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$student = new User();
	
	$details = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);
	$query_result = $student->register($details);
	
	if ($query_result != '0') {
		// Show Error
		@session_start();
		$_SESSION["flashMessages"] = $student->getError();
	}
	else {
		// add student to session
		@session_start();
		$_SESSION["student"] = $student;
		$_SESSION["hasRegistered"] = $student->getRegistrationStatus();

		// redirect to homepage
		header('Location: index.html.php');
	}
}

?>

<!DOCTYPE html>
<html land="en">
<head>
	<title>NITx-Register</title>
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
		<h1>Sign Up</h1>
		<form id="register" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
			</div>

			<div class="form-group">
				<label for="rollNum">Roll Number</label>
				<input type="text" class="form-control" id="rollNum" name="rollNum" placeholder="Roll Number">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				</div>

				<div class="form-group col-md-6">
					<label for="password2">Re-Enter Password</label>
					<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
				</div>
			</div>

			<button form="register" type="submit" class="btn btn-outline-success">Register</button>
		</form>
	</main>


	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>
