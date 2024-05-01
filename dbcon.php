<?php
//$conn = mysqli_connect('localhost','root','','tambira') or die(mysqli_error());

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tambiradb';

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

$errorMsg = "";
?>