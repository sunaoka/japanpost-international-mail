<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once dirname(__DIR__) . '/vendor/autoload.php';

date_default_timezone_set('UTC');

$district = config('app.district');
$metaFile = "{$district}/meta.json";
$current = json_decode(file_get_contents("{$district}/meta.json"), true, 512, JSON_THROW_ON_ERROR);

$meta = [
    'date' => $current['date'],
    'md5'  => array_fill_keys(Language::values(), ''),
];

$crawler = new Crawler();

try {
    $jsonFlags = JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE;
    /** @var Language $language */
    foreach (config('app.languages') as $language) {
        $destinations = $crawler->crawl($language);
        $file = config("{$language->value}.file");
        $json = json_encode($destinations, $jsonFlags);

        $meta['md5'][$language->value] = md5($json);
        if ($current['md5'][$language->value] !== $meta['md5'][$language->value]) {
            $meta['date'] = date(DATE_ATOM);
            file_put_contents("{$district}/{$file}", $json);
        }

        if ($meta['date'] !== $current['date']) {
            file_put_contents($metaFile, json_encode($meta, $jsonFlags));
        }
    }
} catch (\Throwable $e) {
    echo '[', get_class($e), '] ', $e->getMessage(), PHP_EOL,
         '    in ', $e->getFile(), ':', $e->getLine(), PHP_EOL;
    exit(1);
}
