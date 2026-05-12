<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Crawler
{
    use Traits\Normalizer;

    private const int LETTER_POST_OFFSET = 1;

    private const int PARCELS_OFFSET = 4;

    private const int EMS_INDEX = 7;

    private const array DELIVERY_INDEXES = [
        '航空' => 0,
        'SAL'  => 1,
        '船便' => 2,
    ];

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
        $crawler?->filter('.alphabet_search .toggleHead')->each(function (BaseCrawler $element) use ($language, &$destinations) {
            $values = $this->extractDestinationValues($element);

            $destinations[] = Destination::make($language, $values);
        });

        return $destinations;
    }

    private function extractDestinationValues(BaseCrawler $element): array
    {
        $values = [
            $this->normalize($element->text()),
            '', '', '',
            '', '', '',
            '',
        ];

        $body = $element->nextAll()->filter('.toggleBody')->first();
        $body->filter('.dlTable > section')->each(function (BaseCrawler $section) use (&$values) {
            $this->fillValuesFromSection($section, $values);
        });

        return $values;
    }

    private function fillValuesFromSection(BaseCrawler $section, array &$values): void
    {
        $el = $section->filter('.dl_hd');
        if ($el->count() === 0) {
            return;
        }

        $header = $this->normalize($el->text());

        match ($header) {
            '通常郵便物' => $this->fillMailValues($section, $values, self::LETTER_POST_OFFSET),
            '小包郵便物' => $this->fillMailValues($section, $values, self::PARCELS_OFFSET),
            'EMS' => $values[self::EMS_INDEX] = $this->extractEmsStatus($section),
            '通関電子データ送信' => null,
            default => throw new \RuntimeException("Unknown header: {$header}"),
        };
    }

    private function fillMailValues(BaseCrawler $section, array &$values, int $offset): void
    {
        $section->filter('dl > div')->each(function (BaseCrawler $item) use (&$values, $offset) {
            $dt = $this->normalize($item->filter('dt')->text());
            $dd = $this->normalize($item->filter('dd')->text());

            foreach (self::DELIVERY_INDEXES as $label => $index) {
                if (!str_contains($dt, $label)) {
                    continue;
                }

                $values[$offset + $index] = mb_substr($dd, 0, 1);
            }
        });
    }

    private function extractEmsStatus(BaseCrawler $section): string
    {
        $divs = $section->filter('div');
        if ($divs->count() <= 1) {
            return '';
        }

        return $this->normalize($divs->last()->text());
    }
}
