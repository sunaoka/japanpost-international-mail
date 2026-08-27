<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Resolver;

final class DeliveryStatusResolver
{
    private const array DELIVERY = [
        '◯' => 'acceptable',
        '△' => 'some_acceptable',
        '✕' => 'not_acceptable',
        '-' => 'no_service',
    ];

    #[\NoDiscard]
    public function map(string $symbol): string
    {
        if (!isset(self::DELIVERY[$symbol])) {
            throw new \UnexpectedValueException("Unknown delivery status '{$symbol}'");
        }

        return self::DELIVERY[$symbol];
    }
}
