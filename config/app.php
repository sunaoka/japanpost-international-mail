<?php

declare(strict_types=1);

use Sunaoka\JapanPostInternationalMail\Enum\Language;

return [
    'district'     => dirname(__DIR__) . '/dist',
    'languages'    => Language::cases(),
    'files'        => [
        Language::JAPANESE->value => 'ja.json',
        Language::ENGLISH->value  => 'en.json',
        Language::CHINESE->value  => 'cn.json',
    ],
    'country.file' => 'country.json',
];
