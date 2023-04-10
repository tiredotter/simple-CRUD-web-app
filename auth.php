<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'localhost');
    define('DB_PASS', 'password');
    define('DB_NAME', 'test-database');
    /* Attempt to connect to MySQL database */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if($connection === false){
        die("ERROR: Could not connect " . mysqli_connect_error());
    }
?>