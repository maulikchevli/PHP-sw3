<?php

session_start();

$fields = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$data = $_SESSION["data"];
$numFields = $data["numFields"];

$image_path = "./upload/" . $_SESSION["image"];
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

	<style>
		html {
			height: 100%;
		}

		body {
			height: 100%;
			background-color: <?php echo $data["bgcolor"]; ?>;
			font-family: <?php echo $data["font_family"]; ?>;
			font-size: <?php echo $data["font_size"]; ?>px;
			color: <?php echo $data["font_color"]; ?>;

			display: flex;
			flex-direction: column;
		}

		.form-body {
			flex: 1 0 auto;
			background-image: url(<?php echo $image_path; ?>);
		}

		.btn-primary {
			background-color: <?php echo $data["font_color"]; ?>;
			border-color: <?php echo $data["font_color"]; ?>;
		}

		.btn-primary:hover {
			background-color: <?php echo ($data["font_color"] . "af"); ?>;
			border-color: <?php echo($data["bgcolor"] . "af"); ?>;
		}

		footer {
			flex-shrink: 0;
		}
	</style>
</head>
<body> 

	<div class="container form-body wrapper"> 
		<h1 style="font-size: 3em;"><?php echo $data["header"] ?></h1>

		<div class="jumbotron">
			<pre class="lead"><?php echo $data["info"] ?></pre>
		</div>

		<form method="post">
			<?php 
			for($i=0;$i < $numFields; $i++) {
			?>

				<div class="form-group row">
					<label class="col-sm-2" for="<?php echo ($fields['field_name' . $i]); ?>"><?php  echo($fields["field_name" . $i]); ?></label>

					<?php
					$field_type = $fields['field_type' . $i];
					if ($field_type  == "checkbox") {
						foreach ($fields[$i . "checks"] as $option) {
					?>
							<div class="form-check-inline">
								<input
									type="checkbox"
									name="<?php echo ($i . 'checks[]'); ?>"
									class="form-check-input"
								>
								<label class="form-check-label"> <?php echo $option ?> </label>
							</div>
					<?php
						}
					}

					elseif ($field_type == "radio") {
						foreach ($fields[$i . "radios"] as $option) {
					?>
							<div class="form-check-inline">
								<input
									type="radio"
									name="<?php echo ($i . 'radios[]'); ?>"
									class="form-check-input"
									<?php 
										if (isset($fields['required' . $i])) {
											echo "required";
										}
									?>
								>
								<label class="form-check-label"> <?php echo $option ?> </label>
							</div>
					<?php
						}
					}
					?>

					<?php
					if ($field_type  != "checkbox" && $field_type != "radio") {
					// dont know why else id not working
					?>
						<input 
							class="form-control col-sm-9" 
							type="<?php echo ($fields['field_type' . $i]); ?>" 
							id="<?php echo ($fields['field_name' . $i]); ?>" 
							name="<?php echo ($fields['field_name' . $i]); ?>"
							<?php 
								if (isset($fields['required' . $i])) {
									echo "required";
								}
							?>
						>
					<?php
					}
					?>

				</div>

			<?php
			}
			?>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		<div class="text-center py-3">
			<?php echo $data["footer"]; ?>
			<hr>
		</div>
	</div>

	<footer class="page-footer font-small unique-color-dark pt-4">
		<?php require 'footer.html.php'; ?>
	</footer>
</body>
<html>
