<?php
//Import PHPMailer classes into the global namespace
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

function sendMail( $email, $verifyLink) {
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

	$mail->Username = "maulikchevliwork@gmail.com";
	$mail->Password = "Maulik123";

	$mail->setFrom('maulikchevliwork@gmail.com', 'Maulik Chevli');
	$mail->addReplyTo('replyto@example.com', 'First Last');

	$mail->addAddress($email);

	$mail->Subject = 'Verify your account';
	$mail->Body = '
	Welcome to our Blog.

	To verify your account click the link below:
	' . $verifyLink;

	if (!$mail->send()) {
		echo "<p>" . "Mailer Error: " . $mail->ErrorInfo . "</p>";
	} else {
		echo "<p>Message sent!</p>";
	}
}

$username="maulik";
$password="admin";

$encrypted_string=openssl_encrypt($username,"AES-128-ECB",$password);
// $decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);

$verifyLink = 'localhost:8888/sw_tools/sw3/assign5/action/verifyUserEmail.php?username='.urlencode($username).'&pass='.urlencode($encrypted_string);

sendMail( 'maulikchevliwork@gmail.com', $verifyLink);

?>

