<?php
require_once "Mail.php";
 
$from = "bomb <bombchoup@gmail.com>";
$to = "maulikchevli <maulikchevli98@gmail.com>";
$subject = "[Site Message]";
$body = "PEAR Mail successfully sent this email.";
 
$host = "smtp.gmail.com";
$username = "bombchoup@gmail.com";
$password = "Barca123";
$port = "587";
 
$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));
 
$mail = $smtp->send($to, $headers, $body);
 
if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
  echo("<p>Message successfully sent!</p>");
 }
?>
