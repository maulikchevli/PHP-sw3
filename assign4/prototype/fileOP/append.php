<?php

$my_file = 'file.txt';

$handle = fopen( $my_file, 'a') or die( 'Cannot open file :' . $my_file);

$data = ' This is the GOOD BOY';

fwrite( $handle, $data);

$new_data = "\n FEED US!!!";

fwrite( $handle, $new_data);

fclose( $handle);
?>
