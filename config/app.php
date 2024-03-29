<?php

declare(strict_types=1);

use Sunaoka\JapanPostInternationalMail\Language;

return [
    'district'         => dirname(__DIR__) . '/dist',
    'languages'        => Language::cases(),
    'country.language' => Language::JAPANESE,
    'country.file'     => 'country.json',
];
