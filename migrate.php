<?php
/**
 * Staha Database Migrator
 * Use this to import the schema to your production database.
 * SECURITY: Delete this file after successful migration!
 */

require_once 'config/db.php';

// Simple security check
if ($_GET['key'] !== 'staha_deploy_2026') {
    die('Unauthorized. Please use the correct migration key.');
}

try {
    // Read schema file
    $schemaPath = 'database/schema.sql';
    if (!file_exists($schemaPath)) {
        throw new Exception("Schema file not found at $schemaPath");
    }

    $sql = file_get_contents($schemaPath);

    // Remove USE statement if it exists (Managed DBs like Aiven usually provide the DB name already)
    // We also remove the CREATE DATABASE statement to avoid permission errors
    $sql = preg_replace('/CREATE DATABASE IF NOT EXISTS `?staha_db`?;/i', '', $sql);
    $sql = preg_replace('/USE `?staha_db`?;/i', '', $sql);

    // Execute the SQL
    $pdo->exec($sql);

    echo "<h1>✅ Migration Successful!</h1>";
    echo "<p>All tables have been created in the database: <strong>" . htmlspecialchars(DB_NAME) . "</strong></p>";
    echo "<p>You can now visit the <a href='jobs.php'>Job Board</a>.</p>";
    echo "<p style='color: red;'><strong>IMPORTANT:</strong> Delete the <code>migrate.php</code> file from your repository and push to GitHub to keep your site secure.</p>";
} catch (Exception $e) {
    echo "<h1>❌ Migration Failed</h1>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Please ensure your environment variables (DB_HOST, DB_USER, etc.) are correctly set in the Render dashboard.</p>";
}
?>