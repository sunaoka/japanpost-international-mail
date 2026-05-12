<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use Sunaoka\JapanPostInternationalMail\Crawler\CountryIdCrawler;
use Sunaoka\JapanPostInternationalMail\Support\Application;
use Sunaoka\JapanPostInternationalMail\Support\JsonFile;

use function Sunaoka\JapanPostInternationalMail\Support\config;

Application::run(static function (): void {
    $language = config('app.country.language');

    $country = new CountryIdCrawler($language);
    $countries = config("{$language->value}.countries");

    $result = [];
    foreach ($countries as $code) {
        $result[$code] = $country->getId($code);
    }

    ksort($result);

    $district = config('app.district');
    JsonFile::write("{$district}/" . config('app.country.file'), $result);
});
