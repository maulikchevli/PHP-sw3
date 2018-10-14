<?php

$filePath = "./uploads/" . $_REQUEST["fileName"];

$filePointer = fopen( $filePath, 'r');
$fileContent = fread( $filePointer, filesize( $filePath));
fclose( $filePointer);

$strPosition = stripos( $fileContent, $_REQUEST["strToSearch"]);

session_start();
if ( $strPosition !== false) {
	$_SESSION["operationResult"] =  "Found at position : $strPosition";
}
else {
	$_SESSION["operationResult"] =  "Could not find string '" . $_REQUEST['strToSearch'] . "' in the file " . $_REQUEST["fileName"];
}

header( 'Location: displayFiles.html.php');

?>
