<?php

   define('DB_SERVER', 'dijkstra.ug.bcc.bilkent.edu.tr');
   define('DB_USERNAME', 'selahattin.oztur');
   define('DB_PASSWORD', 'sFXKHkZQ');
   define('DB_DATABASE', 'selahattin_ozturk');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (!$db) {
    die("connection error. " . mysqli_connect_error());
}

?>
