<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Resolver;

use function Sunaoka\JapanPostInternationalMail\Support\config;

final class ZoneCountryCodeResolver
{
    private const array UNKNOWN_COUNTRY_NAMES = [
        'Other islands of Oceania',
        'Spanish Overseas Territories',
        'Spanish Overseas Territories Canary Islands Ladu Ceuta Chafarinas Islands Balearic Islands Melilla',
        'Territories of the United States (Guam, Saipan, Midway, Northern Mariana Islands, Wake, America Samoa, Puerto Rico, Virgin Islands)',
        'U.S. overseas territories Wake Island Northern Mariana Islands Guam Puerto Rico Virgin Islands American Samoa Midway Islands',
    ];

    private const array COUNTRY_NAME_ALIASES = [
        'Rep. of Korea'                                            => 'Republic of Korea',
        'Marshall'                                                 => 'Marshall Islands',
        'Micronesia'                                               => 'Federated States of Micronesia',
        'Vietnam'                                                  => 'Viet Nam',
        'Laos'                                                     => 'Lao People\'s Democratic Republic',
        'Samoa'                                                    => 'Independent State of Samoa',
        'Solomon'                                                  => 'Solomon Islands',
        'Curaçao'                                                  => 'Curacao',
        'Saint-Pierre et Miquelon'                                 => 'St. Pierre and Miquelon',
        'Sint Maarten'                                             => 'Saint Maarten',
        'Turks and Caicos Islands'                                 => 'Turks and Caicos',
        'Bermuda Islands'                                          => 'Bermuda',
        'Vatican City'                                             => 'Vatican',
        'Caribbean Netherlands (Bonaire, Saba and Sint Eustatius)' => 'Bonaire, Saba and Sint Eustatius',
        'Northern Islands'                                         => 'North Islands',
        'Portugal (including Azores and Madeira Islands ）'         => 'Portugal',
        'Serbia and Montenegro'                                    => 'Montenegro',
        'United Kingdom'                                           => 'United Kingdom of Great Britain and Northern Ireland',
        'Surinam'                                                  => 'Suriname',
        'Falkland Islands (Islas Malvinas)'                        => 'Falkland',
        'Comoros'                                                  => 'Comoros Islands',
        'Congo-Kinshasa'                                           => 'The Democratic Republic of the Congo',
        'Sao Tome And Principe'                                    => 'Sao Tome and Principe',
        'St. Helena & Dependencies'                                => 'St. Helena',
        'Cote d\'Ivoire'                                           => 'Ivory Coast',
        'Tanzania'                                                 => 'Tanzania (United Rep.)',
        'Central African Republic'                                 => 'Central Africa',
        'Republic of South Africa'                                 => 'South Africa',
        'United States'                                            => 'United States of America',
        'Korea'                                                    => 'Republic of Korea',
        'Great Britain'                                            => 'United Kingdom of Great Britain and Northern Ireland',
    ];

    private const array UNITED_STATES_TERRITORIES = [
        'Wake Island',
        'Northern Mariana Islands',
        'Guam',
        'Puerto Rico',
        'Virgin Islands',
        'American Samoa',
        'Midway Islands',
    ];

    private array $countries;

    public function __construct()
    {
        $this->countries = config('english.countries');
    }

    #[\NoDiscard]
    public function resolveAll(array $countryNames): array
    {
        $resolved = [];

        foreach ($this->expandCountryNames($countryNames) as $countryName) {
            $countryCode = $this->resolve($countryName);
            if ($countryCode === null) {
                continue;
            }

            $resolved[] = $countryCode;
        }

        return array_values(array_filter($resolved));
    }

    #[\NoDiscard]
    private function expandCountryNames(array $countryNames): array
    {
        if (!in_array('United States of America', $countryNames, true)) {
            return $countryNames;
        }

        return [...$countryNames, ...self::UNITED_STATES_TERRITORIES];
    }

    #[\NoDiscard]
    private function resolve(string $countryName): ?string
    {
        if (in_array($countryName, self::UNKNOWN_COUNTRY_NAMES, true)) {
            return null;
        }

        $normalized = self::COUNTRY_NAME_ALIASES[$countryName] ?? $countryName;

        return $this->countries[$normalized] ?? null;
    }
}
