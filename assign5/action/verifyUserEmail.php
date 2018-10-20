<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';
require_once '../model/blog.php';

$username = $_REQUEST["username"];

$encrypted_value = $_REQUEST["pass"];

$decrypted_value = openssl_decrypt( $encrypted_value, "AES-128-ECB", "password");

if ( $username != $decrypted_value) {
	@session_start();
	$_SESSION["flashError"] = "The link is not correct!";
	// TODO facility for Resend_Verification
	header( 'Location: ../view/index.html.php');
}

@session_start();

if ( !isset( $_SESSION["user"])) {
	$user = new User( $username);
	$user->updateEmailVerification();

	$_SESSION["flashSuccess"] = "Email verified :D";
	header( 'Location: ../view/login.html.php');
}

$user = $_SESSION["user"];
$user->updateEmailVerification();

$_SESSION["flashSuccess"] = "Email verified :D";
header( 'Location: ../view/index.html.php');

?>
