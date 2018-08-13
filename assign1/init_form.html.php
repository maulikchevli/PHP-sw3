<!DOCTYPE html>
<html lang="en">
<head>
	<title>MYX</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- css files -->
	<link rel="stylesheet" href="css/main.css">
</head>
<body>

	<header class="container-fluid sticky-top">
		<?php require 'header.html.php'; ?>
	</header>

	<main class="container">
		<form action="fields_form.html.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="header">Header:</label>
				<input type="text" class="form-control" id="header" placeholder="Form header" name="header" required>
			</div>

			<div class="form-group">
				<label for="numFields">Number of Fields:</label>
				<input type="number" class="form-control" id="numFields" placeholder="Number of fields" name="numFields" required>
			</div>

			<div class="form-group">
				<label for="info">Information about form:</label>
				<textarea class="form-control" rows="5" id="info" placeholder="Enter content here" name="info" required></textarea>
			</div>


			<div class="form-row">
				<div class="form-group">
					<label for="font_family">Font family:</label>
					<select class="form-control" name="font_family" id="font_family" required>
						<option value="Times">Times</option>
						<option value="Arial">Arial</option>
						<option value="Georgia">Georgia</option>
						<option value="Helvetica">Helvetica</option>
						<option value="Fantasy">Fantasy</option>
						<option value="Monospace">Monospace</option>
					</select>
				</div>

				<div class="form-group col">
					<label for="font_size">Font Size:</label>
					<input type="number" class="form-control" id="font_size" name="font_size" placeholder="Size of Font" required value="18">
				</div>

				<div class="form-group col">
					<label for="font_color">Font Color:</label>
					<input type="color" class="form-control" id="font_color" name="font_color" required>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col">
				  <label for="bgcolor">Background color:</label>
				  <input class="form-control" type="color" id="bgcolor" name="bgcolor" required>
				</div>

				<div class="form-group col">
					<label for="bgimage">Background Image:</label>
					<input type="file" name="bgimage" id="bgimage" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="footer">footer:</label>
				<input type="text" class="form-control" id="footer" placeholder="footer" name="footer">
			</div>
	 
			<button type="submit" class="btn btn-primary">Next ></button>
		</form>
	</main>

	<footer class="footer">
		<?php require 'footer.html.php'; ?>
	</footer>

</body>
</html>
