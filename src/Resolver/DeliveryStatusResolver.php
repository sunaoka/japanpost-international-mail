<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Resolver;

use Sunaoka\JapanPostInternationalMail\Enum\Language;

use function Sunaoka\JapanPostInternationalMail\Support\config;

final class DeliveryStatusResolver
{
    private array $delivery;

    public function __construct(Language $language)
    {
        $this->delivery = config("{$language->value}.delivery");
    }

    #[\NoDiscard]
    public function map(string $symbol): string
    {
        return $this->delivery[$symbol];
    }
}
