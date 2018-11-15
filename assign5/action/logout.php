<?php
require_once '../model/user.php';
require_once '../model/dbConnection.php';

@session_start();

$_SESSION["user"]->updateLastLogin();

unset( $_SESSION["user"]);
header( 'Location: ../view/index.html.php');
?>
