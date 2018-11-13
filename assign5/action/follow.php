<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';
require_once '../model/notification.php';

$username = $_REQUEST["username"];
@session_start();
$user = $_SESSION["user"];
$result = $user->follow( $username);

if ( $result == false) {
	$_SESSION["flashError"] = "Try again. Could not follow";
	header( 'Location: ../view/profile.html.php?username='.$username);
}

$notifHandler = new Notification( $user->getUsername(), $username, "follow", 0);

// handle error state
$notifHandler->store();

$_SESSION["flashSuccess"] = "You followed $username".
header( 'Location: ../view/profile.html.php?username='.$username);

?>
