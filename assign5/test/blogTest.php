<?php
require_once '../model/blog.php';
require_once '../model/user.php';
require_once '../model/dbConnection.php';

$blog = new Blog( 'naman', 'Post it');

$Maulik = new Blogger( 'naman');

$result = $Maulik->postBlog( $blog);

if ( $result == true) {
	echo "POSTED \n";
}
else {
	echo $Maulik->getError() . "<br>";
	echo "sorry <br>";
}
?>
