<?php

declare(strict_types=1);

/**
 * @param string     $key
 * @param mixed|null $default
 *
 * @return mixed
 */
function config(string $key, mixed $default = null): mixed
{
    static $config = [];

    if (str_contains($key, '.') === false) {
        return $default;
    }

    [$file, $item] = explode('.', $key, 2);

    if (!isset($config[$file])) {
        $path = dirname(__DIR__, 2) . "/config/{$file}.php";

        if (!is_readable($path)) {
            return $default;
        }

        /** @noinspection PhpIncludeInspection */
        $config[$file] = require($path);
    }

    return $config[$file][$item] ?? $default;
}
