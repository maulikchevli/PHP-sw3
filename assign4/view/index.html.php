<?php
require_once '../model/User.php'; // Used in courseDetails.html.php
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
		if( isset( $_SESSION["customer"])) {
		?>
			<form method="post" action="../action/uploadFile.php" enctype="multipart/form-data">
				<hr>
				<div class="form-group">
					<label for="file">File to Upload</label>
					<input type="file" id="file" name="file" required>
				</div>

				<button type="submit" class="btn btn-outline-success">
					Upload File
				</button>
			</form>

		<?php
		}
		else {
			echo "Login to Upload text files";
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

