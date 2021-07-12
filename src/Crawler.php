<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Goutte\Client;
use Normalizer;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;

class Crawler
{
    /**
     * @param Language $language
     *
     * @return Destination[]
     */
    public function crawl(Language $language): array
    {
        $client = new Client();

        try {
            $crawler = $client->request('GET', config("{$language->getValue()}.uri"));
        } catch (\Error $e) {

        }

        $destinations = [];
        $crawler?->filter('#country_table')->eq(0)->filter('tr')->each(function (BaseCrawler $element) use ($language, &$destinations) {
            $columns = $element->filter('td');
            if (count($columns) === 0) {
                return;
            }
            $values = $columns->each(function (BaseCrawler $node, $i) {
                return $this->normalize($node->text());
            });

            $destinations[] = Destination::make($language, $values);
        });

        return $destinations;
    }

    private function normalize(string $string): string
    {
        $string = Normalizer::normalize($string);
        $string = str_replace(chr(194) . chr(160), '', $string);  // \u00A0
        $string = trim($string);

        return $string;
    }
}
