<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Crawler;

use Symfony\Component\DomCrawler\Crawler as BaseCrawler;
use Sunaoka\JapanPostInternationalMail\Resolver\ZoneCountryCodeResolver;
use Sunaoka\JapanPostInternationalMail\Support\WebPage;

final class ZoneCountryListCrawler
{
    #[\NoDiscard]
    public function crawl(string $url): array
    {
        $crawler = WebPage::fetch($url);

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

        if (count($countries) === 0) {
            throw new \RuntimeException("{$url}: No countries found.");
        }

        return $countries
                |> array_filter(...)
                |> array_values(...)
                |> (new ZoneCountryCodeResolver())->resolveAll(...);
    }
}
