<?php
    define('DB_HOST', 'localhost');
    define('DB_USER','marijaya_sales');
    define('DB_PASS','asdasd123456789');
    define('DB_NAME','marijaya_marijayasales');
	
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
    if (mysqli_connect_errno()){
        echo "Failed to connect to MYSQL" . mysqli_connect_error();
        die();
    }
?>