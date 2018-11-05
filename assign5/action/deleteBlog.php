<?php

require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

@session_start();
$user = $_SESSION["user"];

$result = $user->deleteBlog( $_REQUEST["blogId"], $user->getUsername());

if ( $result == true) {
	$_SESSION["flashSuccess"] = "Blog successfully deleted";
}
else {
	$_SESSION["flashError"] = "Sorry. Try again";
}
header( 'Location: ../view/profile.html.php?username=' . $user->getUsername());

?>
