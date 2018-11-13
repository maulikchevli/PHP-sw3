<?php
require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';
require_once '../model/notification.php';

@session_start();
$user = $_SESSION["user"];

if ( $user->likeBlog( $_REQUEST["blogId"])) {
	$blog = new Blog( "", "", "", $_REQUEST["blogId"]);

	if (! ($blog->getOwner() == $user->getUsername())) {
		$notifHandler = new Notification( $user->getUsername(), $blog->getOwner(), "like", $blog->getBlogId());
		
		// handle error state
		$notifHandler->store();
	}
	$_SESSION["flashSuccess"] = ":D";
}
else {
	$_SESSION["flashError"] = "Sorry like failed";
}

header( 'Location: ../view/blog.html.php?blogId='.$_REQUEST["blogId"]);
?>
