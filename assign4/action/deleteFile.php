<?php
require_once '../model/user.php';
require_once 'helper.php';

@session_start();

// TODO security

$fileDirectory = "../uploads/";
$fileName = $_REQUEST["fileName"];

$isDeleted = DeleteFile( $fileName, $_SESSION["customer"]);

if ( $isDeleted != "0") {
	$_SESSION["flashMessages"] = $isDeleted;
	
	header( 'Location: ../view/displayFiles.html.php');
}

$_SESSION["flashMessages"] = "File Deleted successfully";
header( 'Location: ../view/displayFiles.html.php');

?>
