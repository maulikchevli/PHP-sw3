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

?>
