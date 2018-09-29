<?php
require_once 'model/User.php';

session_start();

$student = $_SESSION['student'];
$queryResult = $student->deleteRegistration();

if ( $queryResult != '0') {
	echo $queryResult;
	echo "Failure ... ";
}
else {
	$_SESSION['hasRegistered'] = $student->getRegistrationStatus();
	header( 'Location: index.html.php');
}
?>
