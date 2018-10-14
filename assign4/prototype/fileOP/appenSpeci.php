<?php
// todo the only right way seems is ro use a tmp file

// this method overrides , not append
  $filename = "file.txt";
  $file = fopen($filename, "c");
  fseek($file, -3, SEEK_END);
  fwrite($file, "Hey there. Welcome to PHP?");
  fclose($file);
?>
