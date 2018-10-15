<!DOCTYPE html>
<html land="en">
<head>
	<title>Mailer</title>
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
		<nav class="navbar navbar-light">
			<div class="navbar-brand">
				<h1>Mailer</h1>
			</div>
			
			<button form="compose" type="submit" class="btn btn-outline-success">Send</button>
		</nav>
	</header>

	<main class="container">
		<form id="compose" action="send.php" method="post">
			<div class="form-group row">
				<label for="receiverEmail" class="col-sm-2 col-form-label">To</label>
				<div class="col-sm-10">
					<input type="text" id="receiverEmail" name="receiverEmail" class="form-control" placeholder="Recipient Email ID" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="ccEmail" class="col-sm-2 col-form-label">CC</label>
				<div class="col-sm-10">
					<input type="text" id="ccEmail" name="ccEmail" class="form-control" placeholder="CC email ID">
				</div>
			</div>

			<div class="form-group row">
				<label for="bccEmail" class="col-sm-2 col-form-label">BCC</label>
				<div class="col-sm-10">
					<input type="text" id="bccEmail" name="bccEmail" class="form-control" placeholder="BCC email ID">
				</div>
			</div>

			<div class="form-group row">
				<label for="subject" class="col-sm-2 col-form-label">Subject</label>
				<div class="col-sm-10">
					<input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
				</div>
			</div>

			<div class="form-group">
				<label for="content">Content</label>
				<textarea rows="20" id="content" name="content" class="form-control" placeholder="Write your mail here..." required></textarea>
			</div>

			<div class="form-group row">
				<label for="senderEmail" class="col-sm-2 col-form-label">Your Email</label>
				<div class="col-sm-10">
					<input type="text" id="senderEmail" name="senderEmail" class="form-control" placeholder="Sender Email ID" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="password" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
					<input type="password" id="password" name="password" class="form-control" placeholder="Password for email" required>
				</div>
			</div>
		</form>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>Mailer technologies</span>
		</div>
	</footer>

</body>
</html>
