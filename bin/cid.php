<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

require_once __DIR__ . '/bootstrap.php';

use Throwable;

use function Sunaoka\JapanPostInternationalMail\Support\config;
use function Sunaoka\JapanPostInternationalMail\Support\encodeJson;

try {
    $language = config('app.country.language');

    $country = new Country($language);
    $countries = config("{$language->value}.countries");

    $result = [];
    foreach ($countries as $code) {
        $result[$code] = $country->getId($code);
    }

    $district = config('app.district');
    $file = config('app.country.file');

    file_put_contents("{$district}/{$file}", encodeJson($result));

} catch (Throwable $e) {
    echo '[', get_class($e), '] ', $e->getMessage(), PHP_EOL,
         '    in ', $e->getFile(), ':', $e->getLine(), PHP_EOL;
    exit(1);
}
