<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
	$details = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);

	$user = new User( $details["username"]);

	$result = $user->login( $details);
	@session_start();

	// dbg
	var_dump( $result);
	if ( $result == false) {
		$_SESSION["flashError"] = $user->getError();
		header( 'Location: ../view/login.html.php');
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

		header( 'Location: ../view/profile.html.php?username=' . $details["username"]);
	}
}
?>
