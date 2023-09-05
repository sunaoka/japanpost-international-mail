<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Support;

use JsonException;
use Sunaoka\JapanPostInternationalMail\Language;

/**
 * @param string     $key
 * @param mixed|null $default
 *
 * @return mixed
 */
function config(string $key, mixed $default = null): mixed
{
    static $config = [];

    [$file, $item] = str_contains($key, '.') ? explode('.', $key, 2) : [$key, null];

    if (!isset($config[$file])) {
        $path = dirname(__DIR__, 2) . "/config/{$file}.php";

        if (is_readable($path)) {
            $config[$file] = require($path);
        }
    }

    if ($item === null) {
        return $config[$file] ?? $default;
    }

    return $config[$file][$item] ?? $default;
}

/**
 * @param string $metaFile
 *
 * @return array
 *
 * @throws JsonException
 */
function loadMeta(string $metaFile): array
{
    if (is_file($metaFile)) {
        return json_decode(file_get_contents($metaFile), true, 512, JSON_THROW_ON_ERROR);
    }

    return [
        'date' => '',
        'md5'  => array_fill_keys(Language::values(), ''),
    ];
}

/**
 * @param mixed $value
 * @param int   $flags
 * @param int   $depth
 *
 * @return string
 *
 * @throws JsonException
 */
function encodeJson(mixed $value, int $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE, int $depth = 512): string
{
    return json_encode($value, JSON_THROW_ON_ERROR | $flags, $depth);
}
