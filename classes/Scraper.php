<?php

class Scraper
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Scrapes jobs from Maritime Union (Conceptual implementation)
     */
    public function scrapeMaritimeUnion($query = '', $vessel = '')
    {
        $baseUrl = "https://maritime-union.com/jobs";
        $url = $baseUrl;

        // Prepare search URL
        if ($query || $vessel) {
            $searchParams = [];
            if ($query)
                $searchParams['q'] = $query;
            if ($vessel)
                $searchParams['v'] = $vessel;
            $url .= "?" . http_build_query($searchParams);
        }

        $html = $this->fetchUrl($url);
        if (!$html)
            return [];

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Updated Selectors based on research
        // Containers are actually <a> tags with href containing /job/
        $jobNodes = $xpath->query("//a[contains(@href, '/job/')]");

        $jobs = [];
        foreach ($jobNodes as $node) {
            $titleNode = $xpath->query(".//div[contains(@class, 'h5title')]", $node)->item(0);
            $companyNode = $xpath->query(".//div[contains(@class, 'job-title')]//strong", $node)->item(0);

            if ($titleNode) {
                $rawTitle = trim($titleNode->nodeValue);
                $link = $this->makeAbsolute($node->getAttribute('href'), "https://maritime-union.com");

                // Attempt to extract rank and vessel from title if not provided
                $detectedRank = $this->extractRank($rawTitle) ?: ($query ?: 'Any');
                $detectedVessel = $this->extractVessel($rawTitle) ?: ($vessel ?: 'Any');

                $job = [
                    'title' => $rawTitle,
                    'link' => $link,
                    'company' => $companyNode ? trim($companyNode->nodeValue) : 'Unknown Company',
                    'vessel_type' => $detectedVessel,
                    'rank' => $detectedRank,
                    'source' => 'Maritime Union',
                    'location' => 'Worldwide'
                ];

                // Only save if it looks like a real job link (contains job ID)
                if (preg_match('/\/job\/\d+/', $link)) {
                    $jobs[] = $job;
                    $this->saveToDb($job);
                }
            }
        }
        return $jobs;
    }

    private function extractRank($title)
    {
        $ranks = ['Master', 'Chief Officer', '2nd Officer', '3rd Officer', 'Chief Engineer', '2nd Engineer', '3rd Engineer', 'ETO', 'AB', 'Oiler', 'Cook', 'Bosun', 'Cadet'];
        foreach ($ranks as $rank) {
            if (stripos($title, $rank) !== false)
                return $rank;
        }
        return null;
    }

    private function extractVessel($title)
    {
        $vessels = ['Tanker', 'Container', 'Bulker', 'Offshore', 'LNG', 'LPG', 'Ro-Ro', 'Passenger', 'Tug', 'Dredger'];
        foreach ($vessels as $v) {
            if (stripos($title, $v) !== false)
                return $v;
        }
        return null;
    }

    private function fetchUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function makeAbsolute($url, $base)
    {
        if (strpos($url, 'http') === 0)
            return $url;
        return rtrim($base, '/') . '/' . ltrim($url, '/');
    }

    private function saveToDb($job)
    {
        // Check if job already exists by link
        $stmt = $this->pdo->prepare("SELECT id FROM jobs WHERE link = ?");
        $stmt->execute([$job['link']]);
        if ($stmt->fetch())
            return;

        $stmt = $this->pdo->prepare("INSERT INTO jobs (title, company, vessel_type, rank, location, link, source, date_posted) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            $job['title'],
            $job['company'],
            $job['vessel_type'],
            $job['rank'],
            $job['location'],
            $job['link'],
            $job['source']
        ]);
    }
}
