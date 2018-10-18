<?php
require_once('../model/user.php');

$user = new Blogger('xyz');
$admin = new Admin('maulik');

echo $user->getUsername();
echo $user->getPermissionLevel();

echo "\n";

echo $admin->getUsername();
echo $admin->getPermissionLevel();
echo "\n";

$admin->setPermissions( $user, 1);

echo $user->getUsername();
echo $user->getPermissionLevel();
?>
