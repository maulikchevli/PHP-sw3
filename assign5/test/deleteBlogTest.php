<?php

require_once '../model/user.php';
require_once '../model/blog.php';
require_once '../model/dbConnection.php';


$blog = new Blog('maulik', 'Post it');

$blog->setBlogId(7);

$admin = new Admin('admin');

$admin->deleteBlog( $blog);

?>
