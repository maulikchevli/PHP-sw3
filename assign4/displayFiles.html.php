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
				<h3>
					<?php echo $file["fileName"]; ?>
				</h3>

				<hr>

				<a href="editFile.html.php?fileName=<?php echo $file["fileName"]; ?>">
					Edit
				</a>

				<pre>
					<?php echo $fileContent; ?>
				</pre>
			</div>

		<?php
			fclose( $filePointer);
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

