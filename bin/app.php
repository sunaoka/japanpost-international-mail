<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use Throwable;

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

    /** @var Language $language */
    foreach (config('app.languages') as $language) {
        $destinations = $crawler->crawl($language);
        $file = config("{$language->value}.file");
        $json = encodeJson($destinations);

        $meta['md5'][$language->value] = md5($json);
        if ($current['md5'][$language->value] !== $meta['md5'][$language->value]) {
            $meta['date'] = date(DATE_ATOM);
            file_put_contents("{$district}/{$file}", $json);
        }

        if ($meta['date'] !== $current['date']) {
            file_put_contents($metaFile, encodeJson($meta));
        }
    }
} catch (Throwable $e) {
    echo '[', get_class($e), '] ', $e->getMessage(), PHP_EOL,
         '    in ', $e->getFile(), ':', $e->getLine(), PHP_EOL;
    exit(1);
}
