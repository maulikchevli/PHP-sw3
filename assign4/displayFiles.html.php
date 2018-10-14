<?php

require_once 'model/User.php';

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
		session_start();
		$files = $_SESSION["customer"]->getFileNames();
		$fileDirectory = "./uploads/";

		while( $file = $files->fetch_assoc()) {
			$filePath = $fileDirectory . $file["fileName"];
			$filePointer = fopen( $filePath, 'r') or die(" Cannot open the file to read");
			$fileContent = fread( $filePointer, filesize( $filePath));
		?>

		<!-- Html for Files here -->
			<div>
				<div class="row">
					<h3 class="col">
						<?php echo $file["fileName"]; ?>
					</h3>

					<!-- Search in file -->
					<form class="form-inline col" action="searchFile.php?fileName=<?php echo $file['fileName']; ?>" method="post">
						<input type="text" name="strToSearch" class="form-control-sm">
						<button type="submit" class="btn btn-primary btn-sm">Search</button>
					</form>
				</div>
				<hr>
				<div class="row">
					<a href="editFile.html.php?fileName=<?php echo $file["fileName"]; ?>" class="col">
						Edit
					</a>
				</div>

				<pre><?php echo $fileContent; ?></pre>
			</div>

		<?php
			fclose( $filePointer);
		}
		?>

		<!-- flash File Operation Result -->
		<div class="operation-result">
			<?php
			if( isset( $_SESSION["operationResult"])) {
			?>

				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

					<?php echo $_SESSION["operationResult"]; ?>
				</div>

			<?php
				unset( $_SESSION["operationResult"]);
			}
			?>
		</div>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>
	
</body>
</html>

