<?php

require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';
require_once '../model/notification.php';

@session_start();
$user = $_SESSION["user"];

if ( $user->commentOnBLog( $_REQUEST["blogId"], $_POST["comment"]) == true) {
	$blog = new Blog( "", "", "", $_REQUEST["blogId"]);

	if (! ($blog->getOwner() == $user->getUsername())) {
		$notifHandler = new Notification( $user->getUsername(), $blog->getOwner(), "comment", $blog->getBlogId());
		
		// handle error state
		$notifHandler->store();
	}
	$_SESSION["flashSuccess"] = "You commented on the post";
}
else{
	$_SESSION["flashError"] = "Sorry comment failed";
}

header( 'Location: ../view/blog.html.php?blogId=' . $_REQUEST["blogId"]);

?>
