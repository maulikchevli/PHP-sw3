<?php

require_once 'helper.php';

$result = AppendAfterLine( $_REQUEST["fileName"], $_REQUEST["position"], $_REQUEST["toAppend"]);

session_start();
$_SESSION["operationResult"] = $result;

header( 'Location: ../view/displayFiles.html.php');
?>
