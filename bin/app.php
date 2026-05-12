<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use function Sunaoka\JapanPostInternationalMail\Support\config;
use function Sunaoka\JapanPostInternationalMail\Support\encodeJson;
use function Sunaoka\JapanPostInternationalMail\Support\loadMeta;

try {
    $district = config('app.district');

    $metaFile = "{$district}/meta.json";

    $current = loadMeta($metaFile);
    $meta = [
        'date' => $current['date'],
        'md5'  => array_fill_keys(Language::values(), ''),
    ];

    $crawler = new Crawler();

    $destinations = $crawler->crawl(Language::ENGLISH);
    usort($destinations, static function (Destination $a, Destination $b): int {
        return $a->countryCode <=> $b->countryCode;
    });

    /** @var Language $language */
    foreach (config('app.languages') as $language) {
        $countries = config("{$language->value}.countries");

        // Update destination name
        foreach ($destinations as $destination) {
            $name = array_search($destination->countryCode, $countries, true);
            if ($name === false) {
                throw new \RuntimeException("No such country '{$destination->countryCode}' in {$language->value}");
            }
            $destination->destination = $name;
        }

        $json = encodeJson($destinations);

        $meta['md5'][$language->value] = md5($json);
        if ($current['md5'][$language->value] !== $meta['md5'][$language->value]) {
            $meta['date'] = date(DATE_ATOM);
            $file = config("{$language->value}.file");
            $result = file_put_contents("{$district}/{$file}", $json);
            if ($result === false || $result === 0) {
                throw new \RuntimeException("Failed to write {$file}");
            }
        }

        if ($meta['date'] !== $current['date']) {
            $result = file_put_contents($metaFile, encodeJson($meta));
            if ($result === false || $result === 0) {
                throw new \RuntimeException("Failed to write {$metaFile}");
            }
        }
    }
} catch (\Throwable $e) {
    echo '[', get_class($e), '] ', $e->getMessage(), PHP_EOL,
         '    in ', $e->getFile(), ':', $e->getLine(), PHP_EOL;
    exit(1);
}
