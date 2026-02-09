<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Normalizer;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Crawler
{
    /**
     * @param Language $language
     *
     * @return Destination[]
     */
    #[\NoDiscard]
    public function crawl(Language $language): array
    {
        $client = new HttpBrowser();

        $crawler = $client->request('GET', config("{$language->value}.uri"));

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
        $str = Normalizer::normalize($string);
        if ($str === false) {
            throw new \RuntimeException('');
        }

        return str_replace("\u{00A0}", '', $str)  // no-break space (&nbsp;)
            |> trim(...);
    }
}
