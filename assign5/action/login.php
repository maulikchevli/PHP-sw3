<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
	$details = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);

	$user = new User( $details["username"]);

	$result = $user->login( $details);
	@session_start();
	if ( $result != true) {
		$_SESSION["flashError"] = $blogger->getError();
	}
	else {
		if ( $user->getPermissionLevel() == 3) {
			$user = new Admin( $details["username"]);
		}
		$_SESSION["user"] = $user;
	}

	header( 'Location: ../view/index.html.php');
}
?>
