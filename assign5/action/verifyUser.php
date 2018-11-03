<?php
require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

@session_start();
$admin = $_SESSION["user"];

$result = $admin->verifyUser( $_REQUEST["username"]);

if ( $result == true) {
	$_SESSION["flashSuccess"] = "User promoted";
}
else {
	$_SESSION["flashError"] = "Operation failed";
}

header( 'Location: ../view/verifyRequests.html.php');
?>
