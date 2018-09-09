<?php

session_start();
unset( $_SESSION["rollNum"]);

header( 'Location: index.html.php');

?>
