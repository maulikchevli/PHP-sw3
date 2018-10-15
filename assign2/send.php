<?php
//Import PHPMailer classes into the global namespace
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

$mailData = $_POST;

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server

$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;

$mail->Username = $mailData["senderEmail"];
$mail->Password = $mailData["password"];

$mail->setFrom($mailData["senderEmail"]);
$mail->addReplyTo('replyto@example.com', 'First Last');

$mail->addAddress($mailData["receiverEmail"]);
//$mail->addCC($mailData["ccEmail"]);
//$mail->addBCC($mailData["bccEmail"]);

$mail->Subject = $mailData["subject"];
$mail->Body = $mailData["content"];
$mail->AltBody = 'This is a plain-text message body';

$ccArray = explode(" ", $mailData["ccEmail"]);
$bccArray = explode(" ", $mailData["bccEmail"]);

for( $i = 0; $i < sizeof( $ccArray); $i++) {
	$mail->addCC( $ccArray[$i]);
}

for( $i = 0; $i < sizeof( $bccArray); $i++) {
	$mail->addBCC( $bccArray[$i]);
}

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
			if (!$mail->send()) {
				echo "<p>" . "Mailer Error: " . $mail->ErrorInfo . "</p>";
			} else {
				echo "<p>Message sent!</p>";
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


