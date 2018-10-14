<?php

session_start();
unset( $_SESSION["customer"]);

header( 'Location: ../view/index.html.php');

?>
