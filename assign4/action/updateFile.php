<?php

require_once 'helper.php';

$result = UpdateFile( $_REQUEST["fileName"], $_REQUEST["fileContent"]);
@session_start();
$_SESSION["operationResult"] = $result;
header( 'Location: ../view/displayFiles.html.php');

?>
