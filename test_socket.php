<?php
try {
    $pdo = new PDO("mysql:unix_socket=/run/mysqld/mysqld.sock;dbname=staha_db", "staha_admin", "staha_secure_pass");
    echo "Successfully connected via socket!\n";
} catch (PDOException $e) {
    echo "Socket connection failed: " . $e->getMessage() . "\n";
}
?>