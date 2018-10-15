<?php

@session_start();
unset( $_SESSION["student"]);
unset( $_SESSION["hasRegistered"]);

header( 'Location: index.html.php');

?>
