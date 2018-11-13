<?php

require_once '../model/user.php';
require_once '../model/dbConnection.php';

$user = new User('maulikchevli');
$details = $user->getDetails();

$lastLogin = new DateTime( $user->getLastLogin());
$now = new DateTime("now");

var_dump( $now > $lastLogin);
?>
