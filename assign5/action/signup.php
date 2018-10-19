<?php

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
	$details = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);

	echo $details["birthDate"] . "<br>";


}

?>
