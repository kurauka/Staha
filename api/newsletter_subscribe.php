<?php
require_once '../config/db.php';

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$rank = $_POST['rank'] ?? 'Any';
$vessel = $_POST['vessel'] ?? 'Any';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO subscribers (email, rank_preference, vessel_preference) VALUES (?, ?, ?)");
    $stmt->execute([$email, $rank, $vessel]);
    echo json_encode(['status' => 'success', 'message' => 'Successfully subscribed!']);
} catch (PDOException $e) {
    if ($e->getCode() == '23000') {
        echo json_encode(['status' => 'error', 'message' => 'You are already subscribed.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
}
