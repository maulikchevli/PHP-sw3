<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
	$details = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);

	$blogger = new Blogger( $details["username"]);

	$result = $blogger->signup($details);
	@session_start();
	if ( $result != true) {
		$_SESSION["flashError"] = $blogger->getError();
		header( 'Location: ../view/signup.html.php');
	}
	else {
		$_SESSION["flashSuccess"] = "Successfully signed up
		Check your email for verification of account";
		$_SESSION["user"] = $blogger;
		header( 'Location: ../view/index.html.php');
	}
}

?>
