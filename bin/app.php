<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use Sunaoka\JapanPostInternationalMail\Crawler\DestinationAvailabilityCrawler;
use Sunaoka\JapanPostInternationalMail\Enum\Language;
use Sunaoka\JapanPostInternationalMail\Model\DestinationAvailability;
use Sunaoka\JapanPostInternationalMail\Resolver\CountryCodeResolver;
use Sunaoka\JapanPostInternationalMail\Support\Application;
use Sunaoka\JapanPostInternationalMail\Support\JsonFile;

use function Sunaoka\JapanPostInternationalMail\Support\config;
use function Sunaoka\JapanPostInternationalMail\Support\encodeJson;
use function Sunaoka\JapanPostInternationalMail\Support\loadMeta;

Application::run(static function (): void {
    $district = config('app.district');
    $metaFile = "{$district}/meta.json";
    $current = loadMeta($metaFile);
    $meta = [
        'date' => $current['date'],
        'md5' => array_fill_keys(Language::values(), ''),
    ];

    $resolver = new CountryCodeResolver();
    $destinations = new DestinationAvailabilityCrawler()->crawl(Language::ENGLISH);
    usort($destinations, static fn (DestinationAvailability $a, DestinationAvailability $b): int => $a->countryCode <=> $b->countryCode);

    /** @var Language $language */
    foreach (config('app.languages') as $language) {
        $localized = array_map(
            static fn (DestinationAvailability $destination): DestinationAvailability => $destination->withLocalizedDestination(
                $resolver->resolveDestination($language, $destination->countryCode),
            ),
            $destinations,
        );
        $json = encodeJson($localized);

        $meta['md5'][$language->value] = md5($json);
        if ($current['md5'][$language->value] === $meta['md5'][$language->value]) {
            continue;
        }

        $meta['date'] = date(DATE_ATOM);
        JsonFile::writeString("{$district}/" . config("{$language->value}.file"), $json);
    }

    if ($meta['date'] !== $current['date']) {
        JsonFile::write($metaFile, $meta);
    }
});
