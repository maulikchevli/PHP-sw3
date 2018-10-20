<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
	$post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING); 

	$result = searchQuery( $post["query"]);

	$users = $result["users"];
}

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
		<div class="row">
			<div class="col">
				<h2>Users</h2>
				<?php
					while( $user = $users->fetch_assoc()) {
				?>
						<a href="../view/profile.html.php?username=<?php echo $user["username"];?>"><?php echo $user["username"];?></a>
						<br>
				<?php
					}
				?>
			</div>

			<div class="col">
				<h2>Blogs</h2>
			</div>
		</div>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>NITx Developer</span>
		</div>
	</footer>

</body>
</html>

