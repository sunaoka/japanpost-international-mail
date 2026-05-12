<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Support;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

final class WebPage
{
    #[\NoDiscard]
    public static function fetch(string $url): Crawler
    {
        return new HttpBrowser()->request('GET', $url);
    }
}
