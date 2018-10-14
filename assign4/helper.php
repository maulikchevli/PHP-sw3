<?php

function UploadFile( $handle, $customer) {
	$targetDir = "./uploads/";
	$targetFile = $targetDir . $handle["file"]["name"];

	if ( file_exists( $targetFile)) {
		return "File Alredy Exists";
	}

	$fileType = strtolower( pathinfo( $targetFile, PATHINFO_EXTENSION));
	if ( $fileType != "txt") {
		return "File is not a text file";
	}

	if ( move_uploaded_file( $handle["file"]["tmp_name"], $targetFile)) {
		// Update in database
		$result = $customer->logFileName( $handle["file"]["name"]);
		if ( $result != "0") {
			return $customer->getError();
		}
		
		return "0";
	}
	else {
		return "Could not move the file";
	}
}

function DeleteFile( $fileName, $customer) {
	$filePath = "./uploads/" . $fileName;

	unlink( $filePath);

	$result = $customer->deleteFileName( $fileName);
	if ( $result != "0") {
		return $customer->getError();
	}

	return "0";
}

function AppendToFile( $fileName, $pos, $toAppend) {
	$filePath = "./uploads/" . $fileName;
	$maxPos = filesize( $filePath);

	if ( $pos > $maxPos) {
		return "Position exceeds..";
	}

	$filePointer = fopen( $filePath, 'r+');
	$fileContent = fread( $filePointer, $maxPos);

	// place file pointer on start position
	rewind( $filePointer);

	// https://stackoverflow.com/questions/8251426/insert-string-at-specified-position
	$newContent = substr_replace( $fileContent, $toAppend, $pos, 0);

	if ( fwrite( $filePointer, $newContent)) {
		fclose( $filePointer);
		return "Sucessfully appended the text!";
	}
	else {
		fclose( $filePointer);
		return "Could not append";
	}
}

?>
