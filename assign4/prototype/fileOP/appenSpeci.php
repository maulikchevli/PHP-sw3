<?php
// todo the only right way seems is ro use a tmp file

// this method overrides , not append
$lineNum = readline('Enter Line number: ');

$filename = "file.txt";
$filePointer = fopen($filename, "r+");

$tmp = "tmp.txt";
$tmpPointer = fopen($tmp, 'r+');

$status = "PASS";
while( $lineNum > 0) {
	if ( feof( $filePointer)) {
		$status = "FAIL";
		break;
	}
	$line = fgets( $filePointer);
	fwrite( $tmpPointer, $line);
	$lineNum--;
}

if( $status == "PASS") {

	$data = "hey there, this data is appended" . "\n";
	fwrite( $tmpPointer, $data);

	while( !feof( $filePointer)) {
		$line = fgets( $filePointer);
		fwrite( $tmpPointer, $line);
	}

	rewind( $filePointer);
	rewind( $tmpPointer);

	while( !feof( $tmpPointer)) {
		$line = fgets( $tmpPointer);
		fwrite( $filePointer, $line);
	}

	fclose( $filePointer);
}

?>
