<?php

require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

@session_start();
$user = $_SESSION["user"];

if ( $user->commentOnBLog( $_REQUEST["blogId"], $_POST["comment"]) == true) {
	$_SESSION["flashSuccess"] = "You commented on the post";
}
else{
	$_SESSION["flashError"] = "Sorry comment failed";
}

header( 'Location: ../view/blog.html.php?blogId=' . $_REQUEST["blogId"]);

?>
