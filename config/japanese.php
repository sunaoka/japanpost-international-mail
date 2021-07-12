<?php

declare(strict_types=1);

return [
    'uri'          => 'https://www.post.japanpost.jp/int/information/overview.html',
    'delivery'     => [
        '◯'  => 'acceptable',
        '△' => 'some_acceptable',
        '×'  => 'not_acceptable',
        '-'  => 'no_service',
    ],
    'restrictions' => [
        '（平常期）' => 'normal',
        '（一時）'   => 'temporary',
        '（遅延）'   => 'delays',
    ],
    'period'       => '。',
    'file'         => 'ja.json',
];
