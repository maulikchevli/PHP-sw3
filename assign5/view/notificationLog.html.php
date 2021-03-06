<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';
require_once '../model/notification.php';

@session_start();
$user = $_SESSION["user"];

$notificationDB = $user->notificationLog();

?>

<!DOCTYPE html>
<html land="en">
<head>
	<title>@<?php echo $user->getUsername();?> Notifications</title>
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
		<h1>Notifications Log</h1>
		<ul>
			<?php 
				while ( $notification = $notificationDB->fetch_assoc()) {
					switch( $notification['type']) {
						case 'like':
							$displayMsg = $notification['sender'] . " liked your post number :" . $notification['reference'];
							break;
						case 'comment':
							$displayMsg = $notification['sender'] . " commented on your post number :" . $notification['reference'];
							break;
						case 'new post':
							$displayMsg = $notification['sender'] . " wrote a new blog, post number :" . $notification['reference'];
							break;
					}
			?>

					<li>
						<?php echo $displayMsg; ?>
					</li>
			<?php
				}
			?>
		</ul>
	</main>

	<footer>
		<?php require_once 'footer.html.php' ?>
	</footer>

</body>
</html>

