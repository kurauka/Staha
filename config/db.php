<?php
/**
 * Database configuration for Staha
 * Optimized for production (Render/Aiven) using environment variables.
 */

// Use environment variables if available, otherwise fallback to local defaults
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'staha_admin');
define('DB_PASS', getenv('DB_PASS') ?: 'staha_secure_pass');
define('DB_NAME', getenv('DB_NAME') ?: 'staha_db');
define('DB_PORT', getenv('DB_PORT') ?: '3306');

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Essential for some managed DBs like Aiven/DigitalOcean
    $pdo->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
    // In production, you might want to log this instead of dying
    die("Connection failed: " . $e->getMessage());
}
?>