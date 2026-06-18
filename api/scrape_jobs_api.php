<?php
require_once '../config/db.php';
require_once '../classes/Scraper.php';

header('Content-Type: application/json');

$rank = $_GET['rank'] ?? '';
$vessel = $_GET['vessel'] ?? '';

$scraper = new Scraper($pdo);
$newJobs = $scraper->scrapeMaritimeUnion($rank, $vessel);

echo json_encode([
    'status' => 'success',
    'count' => count($newJobs),
    'jobs' => $newJobs
]);
