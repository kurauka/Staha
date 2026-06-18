<?php
/**
 * Newsletter Sender Script
 * Recommended to run weekly via cron.
 * Usage: php scripts/send_newsletter.php
 */

require_once __DIR__ . '/../config/db.php';

// Fetch active subscribers
$stmt = $pdo->query("SELECT email FROM subscribers WHERE status = 'active'");
$subscribers = $stmt->fetchAll(PDO::FETCH_COLUMN);

if (empty($subscribers)) {
    die("[LOG] No active subscribers found.\n");
}

// Fetch latest 5 jobs
$stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC LIMIT 5");
$latestJobs = $stmt->fetchAll();

if (empty($latestJobs)) {
    die("[LOG] No new jobs to send in newsletter.\n");
}

$subject = "Your Weekly Maritime Dispatch: " . count($latestJobs) . " New Opportunities";

// Build HTML Content (Conceptual - would use a proper template in production)
$content = "
<div style='font-family: sans-serif; max-width: 600px; margin: auto; border: 1px solid #eee; border-radius: 20px; overflow: hidden;'>
    <div style='background: #0284c7; color: white; padding: 40px; text-align: center;'>
        <h1 style='margin:0;'>Staha Weekly Dispatch</h1>
        <p style='margin-bottom:0; opacity: 0.8;'>Top maritime opportunities selected for you.</p>
    </div>
    <div style='padding: 40px;'>
        <h2 style='color: #1e293b;'>Latest Opportunities</h2>
";

foreach ($latestJobs as $job) {
    $content .= "
        <div style='border-bottom: 1px solid #eee; padding: 20px 0;'>
            <h3 style='margin:0; color: #0284c7;'>{$job['title']}</h3>
            <p style='margin: 5px 0; color: #64748b;'>{$job['company']} • {$job['vessel_type']}</p>
            <a href='{$job['link']}' style='display:inline-block; background: #0284c7; color: white; padding: 8px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; margin-top: 10px;'>View Job</a>
        </div>
    ";
}

$content .= "
        <div style='text-align: center; margin-top: 40px;'>
            <a href='http://staha.app/jobs.php' style='color: #0284c7; font-weight: bold;'>View All Jobs</a>
        </div>
    </div>
    <div style='background: #f8fafc; padding: 20px; text-align: center; color: #94a3b8; font-size: 12px;'>
        &copy; " . date('Y') . " Staha Maritime. All rights reserved.<br>
        <a href='#' style='color: #94a3b8;'>Unsubscribe</a>
    </div>
</div>
";

// Send Simulation / Logging
echo "[LOG] Sending campaign: $subject\n";
echo "[LOG] Recipients: " . count($subscribers) . "\n";

// In a real app, use PHPMailer or mail() in a loop
// For this task, we log the campaign to the DB
$stmt = $pdo->prepare("INSERT INTO newsletters (subject, content, recipients_count) VALUES (?, ?, ?)");
$stmt->execute([$subject, $content, count($subscribers)]);

echo "[LOG] Newsletter campaign logged successfully.\n";
