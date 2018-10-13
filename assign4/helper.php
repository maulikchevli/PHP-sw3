<?php

function UploadFile( $handle) {
	$targetDir = "./uploads/";
	$targetFile = $targetDir . $handle["file"]["name"];

	if ( file_exists( $targetFile)) {
		return "-1";
	}

	$fileType = strtolower( pathinfo( $targetFile, PATHINFO_EXTENSION));
	if ( $fileType != "txt") {
		return "-2";
	}

	if ( move_uploaded_file( $handle["file"]["tmp_name"], $targetFile)) {
		return "0";
	}
	else {
		return "-3";
	}
}
?>
