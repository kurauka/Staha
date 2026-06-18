<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['job_id'])) {
    $userId = $_SESSION['user_id'];
    $jobId = $_GET['job_id'];

    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO saved_jobs (user_id, job_id) VALUES (?, ?)");
        $stmt->execute([$userId, $jobId]);
        header("Location: jobs.php?saved=1");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: jobs.php");
}
?>