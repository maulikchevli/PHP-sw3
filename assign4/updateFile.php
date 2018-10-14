<?php

$filePath = "./uploads/" . $_REQUEST["fileName"];

$filePointer = fopen( $filePath, 'w');

if ( fwrite( $filePointer, $_REQUEST["fileContent"])) {
	fclose( $filePointer);
	session_start();
	$_SESSION["flashMessages"] = "File Updated successfully";
	header( 'Location: displayFiles.html.php');
}
else {
	fclose( $filePointer);
	session_start();
	$_SESSION["flashMessages"] = "Could not update the file";
	header( 'Location: displayFiles.html.php');
}

?>
