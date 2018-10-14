<?php

$filePath = "./uploads/" . $_REQUEST["fileName"];

$filePointer = fopen( $filePath, 'r');
$fileContent = fread( $filePointer, filesize( $filePath));
fclose( $filePointer);

$strPosition = stripos( $fileContent, $_REQUEST["strToSearch"]);

if ( $strPosition !== false) {
	echo "Found at position : $strPosition";
}
else {
	echo "Could not find string '" . $_REQUEST['strToSearch'] . "' in the file";
}

?>
