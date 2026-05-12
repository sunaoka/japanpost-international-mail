<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use Sunaoka\JapanPostInternationalMail\Crawler\ZoneCountryListCrawler;
use Sunaoka\JapanPostInternationalMail\Support\Application;
use Sunaoka\JapanPostInternationalMail\Support\JsonFile;

use function Sunaoka\JapanPostInternationalMail\Support\config;

Application::run(static function (): void {
    $district = config('app.district');
    $zones = config('zone');
    $crawler = new ZoneCountryListCrawler();

    $countries = [];
    foreach ($zones as $type => $urls) {
        foreach ($urls as $zone => $url) {
            $countries[$type][$zone] = $crawler->crawl($url);
        }
    }

    JsonFile::write("{$district}/zone.json", $countries);
});
