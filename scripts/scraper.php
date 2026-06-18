<?php
require_once __DIR__ . '/../config/db.php';

/**
 * Staha Job Scraper Script
 * This script demonstrates the concept of scraping maritime jobs.
 * For MVP, we use a simulation but the logic is ready for real extraction.
 */

function scrapeMaritimeJobs($pdo)
{
    echo "Starting scraper session...\n";

    // In a real scenario, you would use curl or file_get_contents on:
    // https://www.maritimeunion.com/jobs
    // https://www.jobatsea.org/

    // Simulation Data (Mimicking extracted items)
    $simulatedJobs = [
        [
            'title' => 'Chief Officer',
            'company' => 'Teekay Tankers',
            'vessel_type' => 'Oil Tanker',
            'rank' => 'Chief Officer',
            'location' => 'Singapore',
            'link' => 'https://example.com/job/1',
            'source' => 'MaritimeUnion'
        ],
        [
            'title' => '2nd Engineer',
            'company' => 'Bernhard Schulte Shipmanagement',
            'vessel_type' => 'Container Ship',
            'rank' => '2nd Engineer',
            'location' => 'Hamburg',
            'link' => 'https://example.com/job/2',
            'source' => 'JobAtSea'
        ],
        [
            'title' => 'Deck Cadet (Trainee)',
            'company' => 'Maersk Line',
            'vessel_type' => 'Container Ship',
            'rank' => 'Cadet',
            'location' => 'Denmark',
            'link' => 'https://example.com/job/3',
            'source' => 'CrewSeekers'
        ],
        [
            'title' => 'Cook',
            'company' => 'Carnival Cruise Line',
            'vessel_type' => 'Cruise Ship',
            'rank' => 'Catering',
            'location' => 'Caribbean',
            'link' => 'https://example.com/job/4',
            'source' => 'MaritimeUnion'
        ],
        [
            'title' => 'Motorman',
            'company' => 'Stena Bulk',
            'vessel_type' => 'Chemical Tanker',
            'rank' => 'Ratings',
            'location' => 'Rotterdam',
            'link' => 'https://example.com/job/5',
            'source' => 'JobAtSea'
        ]
    ];

    $inserted = 0;
    foreach ($simulatedJobs as $job) {
        $stmt = $pdo->prepare("SELECT id FROM jobs WHERE title = ? AND company = ?");
        $stmt->execute([$job['title'], $job['company']]);
        if (!$stmt->fetch()) {
            $stmt = $pdo->prepare("INSERT INTO jobs (title, company, vessel_type, rank, location, link, source) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$job['title'], $job['company'], $job['vessel_type'], $job['rank'], $job['location'], $job['link'], $job['source']]);
            $inserted++;
        }
    }

    echo "Scraper finished. $inserted new jobs added.\n";
}

scrapeMaritimeJobs($pdo);
?>