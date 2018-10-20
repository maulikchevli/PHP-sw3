<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

$username = $_REQUEST["username"];
@session_start();

$result = $_SESSION["user"]->unfollow( $username);

if ( $result == false) {
	$_SESSION["flashError"] = "Try again. Could not unfollow";
	header( 'Location: ../view/profile.html.php?username='.$username);
}

$_SESSION["flashSuccess"] = "You unfollowed $username".
header( 'Location: ../view/profile.html.php?username='.$username);

?>
