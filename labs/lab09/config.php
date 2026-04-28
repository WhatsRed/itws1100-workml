<?php
$host = "localhost";
$user = "phpmyadmin";
$password = "Quite75Money"; 
$dbname = "iit";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>