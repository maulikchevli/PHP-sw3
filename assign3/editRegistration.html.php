<?php
require_once 'model/User.php';
session_start();

$student = $_SESSION['student'];
$courseDetails = $student->getRegistrationDetails( $student->getRollNum());
?>

<!DOCTYPE html>
<html land="en">
<head>
	<title>NITx-edit</title>
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
		<h3>Update Details</h3>

		<a href="deleteRegistration.php">Delete registration</a>

		<form method="post" action="updateRegistration.php">
			<div class="form-group">
				<label for="elective">Elective</label>
				<input type="text" class="form-control" id="elective" name="elective" value="<?php echo $courseDetails['elective']; ?>">
			</div>

			<div class="form-group">
				<label for="club">Clubs</label>
				<input type="text" class="form-control" id="club" name="club" value="<?php echo $courseDetails['club']; ?>">
			</div>

			<button type="submit" class="btn btn-outline-success">
				Update
			</button>
			<a class="btn btn-outline-warning" href="index.html.php">
				Cancel
			</a>
		</form>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>
