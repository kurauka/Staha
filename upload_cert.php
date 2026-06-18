<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['certificate'])) {
    $userId = $_SESSION['user_id'];
    $certName = $_POST['cert_name'];
    $issueDate = $_POST['issue_date'] ?: null;
    $expiryDate = $_POST['expiry_date'] ?: null;

    $targetDir = "uploads/certs/";
    if (!is_dir($targetDir))
        mkdir($targetDir, 0777, true);

    $fileName = time() . "_" . basename($_FILES['certificate']['name']);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['certificate']['tmp_name'], $targetFilePath)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO certificates (user_id, name, issue_date, expiry_date, file_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $certName, $issueDate, $expiryDate, $targetFilePath]);
            header("Location: profile.php?upload=success");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    } else {
        header("Location: profile.php?upload=error");
    }
} else {
    header("Location: profile.php");
}
?>