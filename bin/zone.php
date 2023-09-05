<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use function Sunaoka\JapanPostInternationalMail\Support\config;
use function Sunaoka\JapanPostInternationalMail\Support\encodeJson;

$district = config('app.district');

$zones = config('zone');

$crawler = new ZoneCrawler();

$countries = [];
foreach ($zones as $type => $urls) {
    foreach ($urls as $zone => $url) {
        $countries[$type][$zone] = $crawler->crawl($url);
    }
}

file_put_contents("{$district}/zone.json", encodeJson($countries));
