<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Country
{
    use Traits\CountryCode;
    use Traits\Normalizer;

    protected array $countryId = [];

    public function __construct(private readonly Language $language)
    {
        $client = new HttpBrowser();
        $crawler = $client->request('GET', config("{$language->value}.uri"));

        $crawler?->filter('.alphabet_search .toggleHead')->each(function (BaseCrawler $element) use ($language, &$destinations) {
            $countryCode = $this->getCountryCode($this->language, $this->normalize($element->text()));

            $href = $element->nextAll()->filter('.toggleBody')?->first()?->filter('.ic-popup')?->attr('href');

            if (preg_match('/cid=(\d+)\Z/', $href, $matches)) {
                $this->countryId[$countryCode] = (int)$matches[1];
            }
        });
    }

    #[\NoDiscard]
    public function getId(string $countryCode): int
    {
        return $this->countryId[$countryCode];
    }
}
