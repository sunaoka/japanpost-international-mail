<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Support;

use Throwable;

final class Application
{
    public static function run(callable $callback): void
    {
        try {
            $callback();
        } catch (Throwable $e) {
            echo '[', $e::class, '] ', $e->getMessage(), PHP_EOL,
            '    in ', $e->getFile(), ':', $e->getLine(), PHP_EOL;
            exit(1);
        }
    }
}
