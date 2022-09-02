<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Country
{
    protected array $countryId = [];

    public function __construct(Language $language)
    {
        $client = new Client();

        $crawler = $client->request('GET', config("{$language->value}.uri"));

        $countries = config("{$language->value}.countries");

        $crawler?->filter('#country option')->each(function (BaseCrawler $element) use ($countries) {
            $cid = $element->attr('data-cid');
            if ($cid === null || $cid === '0') {
                return;
            }

            $countryCode = $countries[$element->text()];
            $this->countryId[$countryCode] = (int)$cid;
        });
    }

    public function getId(string $countryCode): int
    {
        return $this->countryId[$countryCode];
    }
}
