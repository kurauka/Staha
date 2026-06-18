<?php
// Database configuration for Staha

define('DB_HOST', 'localhost');
define('DB_USER', 'staha_admin');
define('DB_PASS', 'staha_secure_pass');
define('DB_NAME', 'staha_db');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In a real app, you might want to log this or show a better error
    die("Connection failed: " . $e->getMessage());
}
?>