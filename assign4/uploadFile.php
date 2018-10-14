<?php 

require_once 'helper.php';
require_once 'model/user.php';

if ( $_SERVER[ "REQUEST_METHOD"] == "POST") {
	session_start();
	$isUploaded = UploadFile( $_FILES, $_SESSION["customer"]);

	if ( $isUploaded != "0") {
		session_start();
		$_SESSION["flashMessages"] = "Could not upload. Error :" . $isUploaded;
		header( 'Location: index.html.php');
	}
	else {
		session_start();
		$_SESSION["flashMessages"] = "File Uploaded !";
		header( 'Location: displayFiles.html.php');
	}
}

?>
