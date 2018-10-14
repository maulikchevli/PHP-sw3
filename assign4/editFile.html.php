<?php
require_once 'model/User.php';
// TODO Security: check if file belongs to user

$fileDirectory = "./uploads/";
$fileName = $_REQUEST["fileName"];

$filePath = $fileDirectory . $fileName;

$filePointer = fopen( $filePath, 'r') or die(" Cannot open the file to read");
$fileContent = fread( $filePointer, filesize( $filePath));

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
		<form method="post" action="updateFile.php?fileName=<?php echo $fileName; ?>">
			<h2> 
				<?php echo $fileName; ?>
			</h2>
			<hr>
			<textarea class="form-control" rows="10" name="fileContent"><?php echo $fileContent; ?></textarea>

			<a href="deleteFile.php?fileName=<?php echo $fileName; ?>" class="btn btn-outline-danger">
				Delete File
			</a>

			<button type="submit" class="btn btn-primary">
				Update File
			</button>
		</form>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>

