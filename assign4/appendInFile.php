<?php

require_once 'helper.php';

$result = AppendToFile( $_REQUEST["fileName"], $_REQUEST["position"], $_REQUEST["toAppend"]);

echo $result;
?>
