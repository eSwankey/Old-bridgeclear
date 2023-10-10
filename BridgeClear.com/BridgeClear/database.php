<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "root";

$mysqli = new mysqli(hostname: $host, 
                     username: $username, 
                     password: $password, 
                     database: $dbname);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

return $mysqli;