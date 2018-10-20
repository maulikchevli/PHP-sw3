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
		$permissionLevel = $user->getPermissionLevel();
		if ( $permissionLevel  == 3) {
			$user = new Admin( $details["username"]);
		} else {
			$user = new Blogger( $details["username"], $permissionLevel);
		}
		// quick fix
		$user->getDetails();
		$_SESSION["user"] = $user;
	}

	header( 'Location: ../view/profile.html.php?username=' . $details["username"]);
}
?>
