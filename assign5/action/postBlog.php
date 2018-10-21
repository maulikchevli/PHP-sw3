<?php

require_once '../model/User.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';

@session_start();

$post = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING);
$blog = new Blog( $_SESSION["user"]->getUsername(), $post["title"], $post["body"]);

$result = $_SESSION["user"]->postBlog( $blog);

if ( $result == true) {
	$_SESSION["flashSuccess"] = "Blog posted";
}
else {
	$_SESSION["flashError"] = "Could not post the blog";
}

header( 'Location: ../view/profile.html.php?username='.$_SESSION["user"]->getUsername());

?>

