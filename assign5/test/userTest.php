<?php
require_once('../model/user.php');

$user = new Blogger('xyz');
$admin = new Admin('maulik');

echo $user->getUsername();
echo $user->getPermissionLevel();

echo "<br>";

echo $admin->getUsername();
echo $admin->getPermissionLevel();
echo "<br>";

$admin->setPermissions( $user, 1);


echo $user->getUsername();
echo $user->getPermissionLevel();
var_dump( $user);
?>
