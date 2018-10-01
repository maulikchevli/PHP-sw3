<?php
require_once 'model/User.php';

session_start();

$student = $_SESSION['student'];
$queryResult = $student->deleteRegistration();

if ( $queryResult != '0') {
	$_SESSION["flashMessages"] = $student->getError();

	header( 'Location: index.html.php');
}
else {
	$_SESSION['hasRegistered'] = $student->getRegistrationStatus();
	header( 'Location: index.html.php');
}
?>
