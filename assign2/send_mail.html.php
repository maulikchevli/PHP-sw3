<?php

$mailData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

var_dump($mailData);

?>
