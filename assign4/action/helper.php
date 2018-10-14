<?php

function UploadFile( $handle, $customer) {
	$targetDir = "../uploads/";
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
	$filePath = "../uploads/" . $fileName;

	$result = $customer->deleteFileName( $fileName);
	if ( $result != "0") {
		return $customer->getError();
	}

	unlink( $filePath);
	return "0";
}

function UpdateFile( $fileName, $content) {
	$filePath = "../uploads/" . $fileName;

	$filePointer = fopen( $filePath, 'w');

	if ( fwrite( $filePointer, $content)) {
		fclose( $filePointer);
		return "File Updated successfully !";
	}
	else {
		fclose( $filePointer);
		return "Could not update the file";
	}
}

function AppendToFile( $fileName, $pos, $toAppend) {
	$filePath = "../uploads/" . $fileName;
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

function AppendAfterLine( $fileName, $lineNum, $toAppend) {
	$filePath = "../uploads/" . $fileName;
	$tmpPath = "../uploads/tmp.txt";

	$filePointer = fopen( $filePath, 'r+');
	$tmpPointer = fopen( $tmpPath, 'w+');

	while( $lineNum > 0) {
		if ( feof( $filePointer)) {
			$status = "FAIL";
			return "Line Number Exceeds..";
		}
		$line = fgets( $filePointer);
		fwrite( $tmpPointer, $line);
		$lineNum--;
	}

	$data = $toAppend . "\n";
	fwrite( $tmpPointer, $data);

	while( !feof( $filePointer)) {
		$line = fgets( $filePointer);
		fwrite( $tmpPointer, $line);
	}

	// Transfer from tmp to original file
	rewind( $filePointer);
	rewind( $tmpPointer);

	while( !feof( $tmpPointer)) {
		$line = fgets( $tmpPointer);
		fwrite( $filePointer, $line);
	}

	fclose( $filePointer);
	unlink( $tmpPointer);

	return "Append succes !";
}

?>
