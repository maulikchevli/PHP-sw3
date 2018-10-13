<?php 

require_once 'helper.php';

if ( $_SERVER[ "REQUEST_METHOD"] == "POST") {
	$isUploaded = UploadFile( $_FILES);

	if ( $isUploaded != "0") {
		echo "Some error occured. Error no :" . $isUploaded;
	}

	// read the file and display it
	$fileName = "./uploads/" . $_FILES["file"]["name"];

	$filePointer = fopen( $fileName, 'r') or die(" Cannot open the file to read");

	$fileContent = fread( $filePointer, filesize( $fileName));

	print( $fileContent);

	$fclose( $filePointer);
}

?>
