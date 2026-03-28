<?php
// config.php

// Database configuration — local defaults; on EC2 + RDS set env vars (e.g. in Apache SetEnv or /etc/environment).
// DB_HOST = RDS endpoint or 127.0.0.1 if MySQL is on the same instance
$host = getenv('DB_HOST') ?: '127.0.0.1';
$dbname = getenv('DB_NAME') ?: 'auth_system';
$username = getenv('DB_USER') ?: 'root';
$dbPassEnv = getenv('DB_PASSWORD');
$password = $dbPassEnv !== false ? $dbPassEnv : '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception for easier debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Stop execution and show error message if connection fails
    die("ERROR: Could not connect to the database. " . $e->getMessage());
}
?>
