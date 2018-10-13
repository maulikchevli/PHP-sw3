<?php

if( $_SERVER["REQUEST_METHOD"] == "POST") {
	$target_dir = "./uploads/";
	$target_file = $target_dir . basename( $_FILES["fileToUpload"]["name"]);

	$uploadOk = 1;
	
	if ( file_exists( $target_file)) {
		echo "SOrry file already exists";
		return;
	}

	if ( move_uploaded_file( $_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo " FIle UPLOADED !";
	}
	else {
		echo "Possible file upload attack!\n";
	}

	var_dump( $_FILES);
}

?>

