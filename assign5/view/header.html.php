<nav class="navbar navbar-light navbar-expand-sm">
	<div class="navbar-brand">
		<a class="navbar-brand" href="index.html.php">NIT</a>
	</div>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<form class="form-inline mx-auto" action="../view/search.html.php" method="post">
			<input class="form-control" type="search" name="query" placeholder="Search profile or blog title">
		</form>

		<ul class="navbar-nav ml-auto">
			<?php
			@session_start();
			if ( isset( $_SESSION["user"])) {
			?>
				<li class="nav-item">
					<a class="nav-link" href="../view/profile.html.php?username=<?php echo $_SESSION['user']->getUsername(); ?>">
						<?php echo $_SESSION["user"]->getUsername(); ?>
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
	<?php
	if( isset( $_SESSION["flashSuccess"])) {
	?>

		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo $_SESSION["flashSuccess"]; ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

	<?php
		unset( $_SESSION["flashSuccess"]);
	}
	?>
</div>

