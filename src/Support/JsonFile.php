<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Support;

final class JsonFile
{
    public static function write(string $path, mixed $value): void
    {
        self::writeString($path, encodeJson($value));
    }

    public static function writeString(string $path, string $contents): void
    {
        $result = file_put_contents($path, $contents);
        if ($result === false || $result === 0) {
            throw new \RuntimeException("Failed to write {$path}");
        }
    }
}
