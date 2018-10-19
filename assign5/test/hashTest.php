<?php

// Use any unique value of the user, hence do not store hash/encrypt

$string_to_encrypt="maulik";
$password="admin";

$encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);
$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);

echo $encrypted_string . "\n";
echo $decrypted_string . "\n";
?>
