<?php 
require_once '../model/dbConnection.php';
require_once '../model/User.php';

$user = new Blogger('user');

$result = $user->signup(' ');
echo $result;

$admin = new Admin('admin');
$result = $admin->signup(' ');

echo "<br> $result";

?>
