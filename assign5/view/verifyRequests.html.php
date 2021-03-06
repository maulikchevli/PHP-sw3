<?php

require_once '../model/user.php';
require_once '../model/dbConnection.php';
require_once '../model/blog.php';

@session_start();

if ( !isset( $_SESSION["user"]) || $_SESSION["user"]->getPermissionLevel() != 3) {
	$_SESSION["flashError"] = "You cannot access that fearure";
	header( 'Location: ../view/index.html.php');
}
?>

<html land="en">
<head>
	<title>NITx-admin</title>
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
		<h2>Verify Request</h2>
		<?php
			$admin = $_SESSION["user"];

			$users = $admin->getVerifyRequests();

			if ( $users == false) {
				echo "Could not retreive users";
			}

			else {
				while( $user = $users->fetch_assoc()) {
				?>

				<div class="row">
					<div class="col-sm-8">
						<p>Username: <a href="../view/profile.html.php?username=<?php echo $user['username']; ?>"><?php echo $user["username"]; ?></a></p>
						<hr>
					</div>

					<div class="col-sm-4">
						permissionLevel: <span><?php echo $user["userType"]; ?></span>
						<a href="../action/verifyUser.php?username=<?php echo $user['username']; ?>" class="btn btn-outline-success">Verify</a>
					</div>
				</div>

				<?php
				}
			}
		?>
	</main>

	<footer class="footer">
		<?php require_once 'footer.html.php'; ?>
	</footer>

	<script src="js/main.js"> </script>

</body>
</html>

