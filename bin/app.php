<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use Sunaoka\JapanPostInternationalMail\Client\AcceptanceCountriesClient;
use Sunaoka\JapanPostInternationalMail\Enum\Language;
use Sunaoka\JapanPostInternationalMail\Model\DestinationAvailability;
use Sunaoka\JapanPostInternationalMail\Support\Application;
use Sunaoka\JapanPostInternationalMail\Support\JsonFile;

use function Sunaoka\JapanPostInternationalMail\Support\config;
use function Sunaoka\JapanPostInternationalMail\Support\encodeJson;
use function Sunaoka\JapanPostInternationalMail\Support\loadMeta;

Application::run(static function (): void {
    $district = config('app.district');
    $current = loadMeta("{$district}/meta.json");
    $meta = [
        'date' => $current['date'],
        'md5'  => array_fill_keys(Language::values(), ''),
    ];

    $japaneseCountries = config('japanese.countries');
    $englishDestinations = config('english.destinations');
    $chineseDestinations = config('chinese.destinations');
    $destinations = [];
    $countryIds = [];

    foreach (new AcceptanceCountriesClient()->fetch() as $country) {
        $japaneseName = $country['国名'];
        $countryCode = $japaneseCountries[$japaneseName] ?? throw new \OutOfRangeException("No ISO country code for '{$japaneseName}'.");
        $englishDestination = $englishDestinations[$countryCode] ?? throw new \OutOfRangeException("No English destination for '{$countryCode}'.");
        $chineseName = $chineseDestinations[$countryCode] ?? throw new \OutOfRangeException("No Chinese destination for '{$countryCode}'.");

        $destinations[$countryCode] = [
            Language::JAPANESE->value => DestinationAvailability::make(
                $countryCode,
                $country['国名'],
                $country['通常郵便物の航空扱い'],
                $country['通常郵便物のSAL扱い'],
                $country['通常郵便物の船便扱い'],
                $country['小包郵便物の航空扱い'],
                $country['小包郵便物のSAL扱い'],
                $country['小包郵便物の船便扱い'],
                $country['EMS'],
            ),
            Language::ENGLISH->value  => $englishDestination,
            Language::CHINESE->value  => $chineseName,
        ];
        $countryIds[$countryCode] = $country['cid'];
    }

    ksort($destinations);
    ksort($countryIds);

    foreach (config('app.languages') as $language) {
        $localized = array_values(
            array_map(
                static fn(array $destination): DestinationAvailability
                    => $destination[Language::JAPANESE->value]->withLocalizedDestination(
                    $language === Language::JAPANESE ? $destination[Language::JAPANESE->value]->destination : $destination[$language->value],
                ),
                $destinations,
            ),
        );
        $json = encodeJson($localized);

        $meta['md5'][$language->value] = md5($json);
        if ($current['md5'][$language->value] === $meta['md5'][$language->value]) {
            continue;
        }

        $meta['date'] = date(DATE_ATOM);
        JsonFile::writeString("{$district}/" . config('app.files')[$language->value], $json);
    }

    $countryFile = "{$district}/" . config('app.country.file');
    $countryJson = encodeJson($countryIds);
    if (!is_file($countryFile) || file_get_contents($countryFile) !== $countryJson) {
        JsonFile::writeString($countryFile, $countryJson);
    }

    if ($meta['date'] !== $current['date']) {
        JsonFile::write("{$district}/meta.json", $meta);
    }
});
