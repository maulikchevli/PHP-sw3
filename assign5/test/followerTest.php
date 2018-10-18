<?php

require_once '../model/dbConnection.php';
require_once '../model/User.php';

$maulik = new Blogger('maulik');

$followers = $maulik->getFollowers();

echo "Number of followers = " . $followers->num_rows . "<br>";

while ( $follower = $followers->fetch_assoc()) {
	echo $follower["follower"] . "\t";
}

echo "<br>";

$followings = $maulik->getFollowings();

echo "number of followers = " . $followings->num_rows . "<br>";
while( $following = $followings->fetch_assoc()) {
	echo $following["username"] . "\t";
}

?>
