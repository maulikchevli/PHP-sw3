<?php

require_once 'model/user.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();

	$courseDetails = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);
	$student = $_SESSION['student'];

	$queryResult = $student->courseRegistration($courseDetails);

	if ( $queryResult != '0') {
		echo $queryResult;
		echo "Failure ... ";
	}
	else {
		$_SESSION['hasRegistered'] = $student->getRegistrationStatus();
		header( 'Location: index.html.php');
	}
}
?>
