<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

enum Language: string
{
    case JAPANESE = 'japanese';

    case ENGLISH = 'english';

    case CHINESE = 'chinese';

    #[\NoDiscard]
    public static function values(): array
    {
        return array_map(static fn(self $case) => $case->value, self::cases());
    }
}
