<?php

// TODO: Think on radio-buttons and checkboxes

session_start();
require 'upload.php';

$requested_data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// store user filled data in session for next page
$_SESSION["data"] = $requested_data;
$_SESSION["image"] = $_FILES["bgimage"]["name"];

UploadImage(); // Function in upload.php

$numFields = $requested_data["numFields"];
?>

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
	<link rel="stylesheet" href="css/fields.css">
</head>
<body>

<div class="container"> 
	<h1>MYX</h1>
	<h3>Fields</h3>

	<form method="post" action="result_form.html.php">

		<?php 

		for ($i=0; $i<$numFields; $i++) {

		?>

		<div class="container" id="<?php echo $i; ?>">
			<div class="row">
				<div class="form-group col-sm-3">
					<label for="field_type<?php echo $i;?>">Field Type</label>
					<select class="form-control field-type" id="field_type<?php echo $i; ?>" name="field_type<?php echo $i; ?>">
						<option value="text">Text</option>
						<option value="number">Number</option>
						<option value="email">Email</option>
						<option value="password">Password</option>
						<option value="color">Color</option>
						<option value="file">File</option>
						<option value="checkbox">Checkbox</option>
						<option value="radio">Radio</option>
					</select>
				</div>

				<div class="form-group col-sm-6">
					<label for="field_name<?php echo $i; ?>">Field Name</label>
					<input type="text" class="form-control" name="field_name<?php echo $i; ?>" id="field_name<?php echo $i; ?>">
				</div>

				<div class="form-group col-sm-3">
					<input type="checkbox" value="required" name="required<?php echo $i; ?>" id="required<?php echo $i; ?>">
					<label for="required<?php echo $i; ?>">Required</label>
				</div>
			</div>

			<div class="row">
				<div class="form-group offset-sm-3 optional checkbox<?php echo $i; ?>">
					<label>Checks</label>
					<input type="text" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="form-group offset-sm-3 optional radio<?php echo $i; ?>">
					<label>Option</label>
					<input type="text" class="form-control">
				</div>
			</div>

		</div>

		<?php

		}

		?>


		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>

<script src="js/fields.js"></script>

</body>
</html>
