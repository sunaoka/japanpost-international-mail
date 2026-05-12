<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Resolver;

use Sunaoka\JapanPostInternationalMail\Enum\Language;

use function Sunaoka\JapanPostInternationalMail\Support\config;

final class CountryCodeResolver
{
    #[\NoDiscard]
    public function resolveCode(Language $language, string $destination): string
    {
        $countries = config("{$language->value}.countries");
        if (!isset($countries[$destination])) {
            throw new \OutOfRangeException("No such country '{$destination}' in {$language->value}");
        }

        return $countries[$destination];
    }

    #[\NoDiscard]
    public function resolveDestination(Language $language, string $countryCode): string
    {
        $countries = config("{$language->value}.countries");
        $destination = array_search($countryCode, $countries, true);
        if ($destination === false) {
            throw new \OutOfRangeException("No such country '{$countryCode}' in {$language->value}");
        }

        return $destination;
    }
}
