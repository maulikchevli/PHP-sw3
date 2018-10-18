<nav class="navbar navbar-light navbar-expand-sm">
	<div class="navbar-brand">
		<a class="navbar-brand" href="index.html.php">NIT</a>
	</div>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<?php
			@session_start();
			if ( isset( $_SESSION["customer"])) {
			?>
				<li class="nav-item">
					<a class="nav-link" href="displayFiles.html.php">
						<?php echo $_SESSION["customer"]->getRollNum(); ?>
					</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="../action/logout.php">Log Out</a>
				</li>

			<?php
			}
			else {
			?>
				<li class="nav-item">
					<a class="nav-link" href="login.html.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="signup.html.php">Sign Up</a>
				</li>
			<?php
			}
			?>
		</ul>
	</div>
</nav>

<div class="flash-message">
	<?php
	if( isset( $_SESSION["flashError"])) {
	?>

		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<?php echo $_SESSION["flashError"]; ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

	<?php
		unset( $_SESSION["flashError"]);
	}
	?>

	<!-- Other display messages here -->
</div>

