<?php

declare(strict_types=1);

return [
    'uri'          => 'https://www.post.japanpost.jp/int/information/overview_en.html',
    'delivery'     => [
        '✔' => 'acceptable',
        '*'  => 'some_acceptable',
        'X'  => 'not_acceptable',
        '-'  => 'no_service',
    ],
    'restrictions' => [
        '(N)' => 'normal',
        '(T)' => 'temporary',
        '(D)' => 'delays',
    ],
    'period'       => '.',
    'file'         => 'en.json',
];
