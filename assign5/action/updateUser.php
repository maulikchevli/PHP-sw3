<?php

require_once '../model/user.php';
require_once '../model/dbConnection.php';
require_once '../model/blog.php';

@session_start();

if ( !isset( $_SESSION["user"]) || $_SESSION["user"]->getPermissionLevel() != 3) {
	$_SESSION["flashError"] = "You cannot access that fearure";
	header( 'Location: ../view/index.html.php');
}

$admin = $_SESSION["user"];

$newPermissions = $_POST["permissionLevel"];
$result = $admin->setPermissions( $_REQUEST["username"], $newPermissions);

if ( $result) {
	$_SESSION["flashSuccess"] = "User's permissions updated";
}
else {
	$_SESSION["flashError"] = "User's permission could not be updated";
}
header( 'Location: ../view/adminPage.html.php');

?>
