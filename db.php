<?php
// Laragon's default MySQL settings
$host = 'localhost';
$user = 'root';
$pass = '';          // Laragon's default password is empty
$name = 'php_login'; // database name (created automatically)

$db = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the database and table the first time the page runs
$db->exec("CREATE DATABASE IF NOT EXISTS $name");
$db->exec("USE $name");
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)");
