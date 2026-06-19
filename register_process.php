<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $rank = $_POST['rank'] ?? null;

    try {
        $stmt = $pdo->prepare("INSERT INTO `users` (`name`, `email`, `password`, `role`, `rank`) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role, $rank]);

        header("Location: login.php?registered=1");
        exit();
    } catch (PDOException $e) {
        // Handle error (e.g. duplicate email)
        die("Error: " . $e->getMessage());
    }
}
?>