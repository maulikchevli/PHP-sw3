<?php
require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

@session_start();
$user = $_SESSION["user"];

if ( $user->unlikeBlog( $_REQUEST["blogId"])) {
	$_SESSION["flashSuccess"] = ":(";
}
else {
	$_SESSION["flashError"] = "Sorry like failed";
}

header( 'Location: ../view/blog.html.php?blogId='.$_REQUEST["blogId"]);
?>
