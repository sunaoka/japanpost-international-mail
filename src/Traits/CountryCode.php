<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Traits;

use Sunaoka\JapanPostInternationalMail\Language;

use function Sunaoka\JapanPostInternationalMail\Support\config;

trait CountryCode
{
    public function getCountryCode(Language $language, string $destination): string
    {
        $countries = config("{$language->value}.countries");
        if (!isset($countries[$destination])) {
            throw new \OutOfRangeException("No such country '{$destination}' in {$language->value}");
        }

        return $countries[$destination];
    }
}
