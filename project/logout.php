<?php
/**
 * CS353 hw4
 * Author: selahattin cem ozturk
 * kills the session
 */
session_start();

$_SESSION = array();

//killing the session 
session_destroy();

// going back to index.php
echo "<script LANGUAGE='JavaScript'>
          window.alert('Logged out...');
          window.location.href='index.php';
       </script>";

exit;
?>
