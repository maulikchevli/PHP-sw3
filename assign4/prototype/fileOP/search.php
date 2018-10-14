<?php 
$fileName = "file.txt";

$strs = readline( 'String to search :');

$filePointer = fopen( $fileName, 'r');

$fileContent = fread( $filePointer, filesize( $fileName));

$pos = strpos( $fileContent, $strs);

var_dump( $fileContent);
echo "\n";
var_dump( $pos);
echo "\n";

if ( $pos !== false) {
	echo " found at '$pos' .\n";
}
else {
	echo "Could not find it.\n";
}
?>
