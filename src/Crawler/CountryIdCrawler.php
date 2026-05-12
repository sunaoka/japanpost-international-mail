<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Crawler;

use Symfony\Component\DomCrawler\Crawler as BaseCrawler;
use Sunaoka\JapanPostInternationalMail\Concerns\NormalizesText;
use Sunaoka\JapanPostInternationalMail\Enum\Language;
use Sunaoka\JapanPostInternationalMail\Resolver\CountryCodeResolver;
use Sunaoka\JapanPostInternationalMail\Support\WebPage;

use function Sunaoka\JapanPostInternationalMail\Support\config;

final class CountryIdCrawler
{
    use NormalizesText;

    protected array $countryId = [];

    public function __construct(private readonly Language $language)
    {
        $resolver = new CountryCodeResolver();
        $crawler = WebPage::fetch(config("{$this->language->value}.uri"));

        $crawler?->filter('.alphabet_search .toggleHead')->each(function (BaseCrawler $element) use ($resolver) {
            $countryCode = $resolver->resolveCode($this->language, $this->normalize($element->text()));

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
