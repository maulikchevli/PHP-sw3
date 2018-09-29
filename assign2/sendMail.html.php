<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
	$b1=$_POST['semail'];
	$b2=$_POST['sepass'];
    //Server settings                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "$b1";                 // SMTP username
    $mail->Password = "$b2";                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom("$b1");
	$a1=$_POST['recemail'];
	//echo '<script>alert("$a1");</script>';
	if($a1!=NULL)
	{
	$mail->addAddress("$a1");     // Add a recipient
	}
	$a2=$_POST['ccemail'];
    if($a2!=NULL)
	{
		$mail->addCC("$a2");
	}
	$a3=$_POST['bccemail'];
	if($a3!=NULL)
	{
		$mail->addBCC("$a3");
	}
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    
	
    //Attachments
	$fname=$_FILES['fname']['name'];
	if($fname!=NULL)
	{
		$mail->addAttachment("$fname");         // Add attachments	
	}
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);	// Set email format to HTML
    $a4=$_POST['sub'];
	if($a4!=NULL)
	$mail->Subject = "$a4";
    //$mail->Body    = 'SW03 <b>2018!</b>';
	$a5=$_POST['con'];
	$mail->Body="$a5";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
   //echo "<script >alert(Subject: $a4 '\n' Messege: $a5);</script>";
   echo "<script >alert('Message has been sent');</script>";
	echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>