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
		<h1>Sign Up</h1>
		<form method="post" action="../action/signup.php">
			<div class="form-row">
				<div class="form-group col">
					<label for="firstName">First Name</label>
					<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
				</div>
				
				<div class="form-group col">
					<label for="lastName">Last Name</label>
					<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
				</div>
			</div>

			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Unique username ( max 20 characters )" required>
			</div>

			<div class="form-group">
				<label for="birthDate">Birth Date</label>
				<input type="date" class="form-control" id="birthDate" name="birthDate" required>
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email for verification and updates" required>
			</div>

			<div class="form-group">
				<label for="bio">Bio</label>
				<textarea rows="2" type="text" class="form-control" id="bio" name="bio" placeholder="Enter a short Bio so other users may know you :)"></textarea>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
				</div>

				<div class="form-group col-md-6">
					<label for="password2">Re-Enter Password</label>
					<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" required>
				</div>
			</div>

			<button type="submit" class="btn btn-outline-success">Register</button>
		</form>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>

