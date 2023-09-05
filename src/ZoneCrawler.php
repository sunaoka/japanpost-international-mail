<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;
use function Sunaoka\JapanPostInternationalMail\Support\config;

class ZoneCrawler
{
    private array $unknownCountryName = [
        'Other islands of Oceania',
        'Spanish Overseas Territories',
        'Spanish Overseas Territories Canary Islands Ladu Ceuta Chafarinas Islands Balearic Islands Melilla',
        'Territories of the United States (Guam, Saipan, Midway, Northern Mariana Islands, Wake, America Samoa, Puerto Rico, Virgin Islands)',
        'U.S. overseas territories Wake Island Northern Mariana Islands Guam Puerto Rico Virgin Islands American Samoa Midway Islands',
    ];

    private array $countryNameAlias = [
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

    public function crawl(string $url): array
    {
        $client = new HttpBrowser();

        $crawler = $client->request('GET', $url);

        $countries = $crawler->filter('#main-box table.data tbody tr')->each(function (BaseCrawler $element) {
            $rows = $element->filter('td');
            if ($rows->count() === 0) {
                return null;
            }

            $col = 0;
            $class = $rows->eq(0)->attr('class');
            if (str_contains((string)$class, 'h2')) {
                $col = 1;
            }

            return $rows->eq($col)->text();
        });

        return array_values(array_filter(array_map(function (string $countryName): ?string {
            if (in_array($countryName, $this->unknownCountryName, true)) {
                return null;
            }
            $counties = config('english.countries');
            return $counties[$this->countryNameAlias[$countryName] ?? $countryName];
        }, array_values(array_filter($countries)))));
    }
}
