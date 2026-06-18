<?php
/**
 * Automated Job Scraper Script
 * Recommended to run every 6-12 hours via cron.
 * Usage: php scripts/cron_update_jobs.php
 */

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../classes/Scraper.php';

$ranks = ['Master', 'Chief Officer', '2nd Officer', '3rd Officer', 'Chief Engineer', 'AB', 'Oiler', 'Cook'];
$vessels = ['Tanker', 'Container', 'Bulker', 'Offshore', 'LNG', 'LPG'];

$scraper = new Scraper($pdo);
$totalNew = 0;

echo "[LOG] Starting automated job update - " . date('Y-m-d H:i:s') . "\n";

foreach ($ranks as $rank) {
    foreach ($vessels as $vessel) {
        try {
            echo "[LOG] Scraping for $rank on $vessel...\n";
            $newJobs = $scraper->scrapeMaritimeUnion($rank, $vessel);
            $totalNew += count($newJobs);
            // Throttle to avoid being blocked
            sleep(2);
        } catch (Exception $e) {
            echo "[ERR] Error scraping $rank / $vessel: " . $e->getMessage() . "\n";
        }
    }
}

echo "[LOG] Automated update complete. Total new jobs: $totalNew\n";
