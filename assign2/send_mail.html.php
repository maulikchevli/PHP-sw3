<?php

//$mailData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$mailData = $_POST;

require_once "Mail.php";
 
$from = $mailData["senderEmail"];
$to = $mailData["receiverEmail"];

// cc and bcc source : https://raamdev.com/2008/adding-cc-recipients-with-pear-mail/
$cc = $mailData["ccEmail"];
$bcc = $mailData["bccEmail"];

$recepients = $to . "," . $bcc;
// from above source

$subject = $mailData["subject"];
$body = $mailData["content"];
 
$host = "tls://smtp.gmail.com";
$username = $mailData["senderEmail"];
$password = $mailData["password"];
$port = "587";
 
$headers = array ('From' => $from,
	'To' => $to,
	'Subject' => $subject,
	'CC' => $cc);

$smtp = @Mail::factory('smtp',array (
		'host' => $host,
		'debug'=> true,
		'port' => $port,
		'auth' => true,
		'username' => $username,
		'password' => $password));
 
$mail = @$smtp->send($recepients, $headers, $body);
?>

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
		</nav>
	</header>

	<main class="container">
		<h3>Response</h3>

		<?php
			if (PEAR::isError($mail)) {
				echo("<p>" . $mail->getMessage() . "</p>");
			}
			else {
				echo("<p>Message successfully sent!</p>");
			}
		?>

		<a class="btn btn-outline-success" href="init_form.html.php">Send Another</a>
	</main>

	<footer class="footer">
		<div class="footer-copyright text-center py-3">
			<span>Mailer technologies</span>
		</div>
	</footer>
</body>


