<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', '21_bojarski');
    define('DB_PASS', 'G5j4n3f6h7');
    define('DB_NAME', '21_bojarski');
    /* Attempt to connect to MySQL database */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if($connection === false){
        die("ERROR: Could not connect " . mysqli_connect_error());
    }
?>