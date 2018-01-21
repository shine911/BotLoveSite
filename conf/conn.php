<?php
    $host = 'localhost';
    $user = 'root';
    $psw = '';
    $dbname = 'botfacebook';
    $mysql = new mysqli($host, $user,  $psw, $dbname);
    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    }
	mysqli_set_charset($mysql, 'UTF8');
?>