<?php

require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

@session_start();

// TODO store additional details of the user
$result = $_SESSION["user"]->sendVerifyRequest();

if ( $result == true) {
	$_SESSION["flashSuccess"] = "Your Request will be taken by admin. Thank You";
}
else {
	$_SESSION["flashError"] = "Sorry, we could not send your request. Try again later";
}

header( 'Location: ../view/profile.html.php?username='.$_SESSION["user"]->getUsername());
?>
