<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

$username = $_REQUEST["username"];
@session_start();

$result = $_SESSION["user"]->follow( $username);

if ( $result == false) {
	$_SESSION["flashError"] = "Try again. Could not follow";
	header( 'Location: ../view/profile.html.php?username='.$username);
}

$_SESSION["flashSuccess"] = "You followed $username".
header( 'Location: ../view/profile.html.php?username='.$username);

?>
