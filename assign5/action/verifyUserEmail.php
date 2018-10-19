<?php

$username = $_REQUEST["username"];

$encrypted_value = $_REQUEST["pass"];
echo $encrypted_value . "<br>";

$decrypted_value = openssl_decrypt( $encrypted_value, "AES-128-ECB", "admin");
echo $decrypted_value . "<br>";

var_dump( $_REQUEST);
var_dump( $decrypted_value);
?>
