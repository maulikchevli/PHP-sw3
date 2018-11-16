<?php

require_once '../model/user.php';
require_once '../model/dbConnection.php';
require_once '../model/blog.php';

$query = $_REQUEST["q"];
$query = "%" . $query ."%";

$db_delegate = new dbConnection('blog');
$sql_query = "select username from user where firstName LIKE '$query'";
$result = $db_delegate->select_query($sql_query);

$arr = array();
while( $user = $result->fetch_assoc()) {
	array_push( $arr, array("name"=> $user["username"]));
}

echo json_encode( $arr);

?>
