<?php

declare(strict_types=1);

return [
    'uri'          => 'https://www.post.japanpost.jp/int/information/overview_cn.html',
    'delivery'     => [
        '◯'  => 'acceptable',
        '△' => 'some_acceptable',
        '×'  => 'not_acceptable',
        '-'  => 'no_service',
    ],
    'restrictions' => [
        '（平常时期）' => 'normal',
        '（暂时）'     => 'temporary',
        '（延迟）'     => 'delays',
    ],
    'period'       => '。',
    'file'         => 'cn.json',
];
