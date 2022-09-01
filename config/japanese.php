<?php

declare(strict_types=1);

return [
    'uri'          => 'https://www.post.japanpost.jp/int/information/overview.html',
    'delivery'     => [
        '◯'  => 'acceptable',
        '○'  => 'acceptable',
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
    'countries'    => [
        '中華人民共和国'                         => 'CN',
        'アメリカ合衆国'                         => 'US',
        '大韓民国'                               => 'KR',
        'フィリピン'                             => 'PH',
        '台湾'                                   => 'TW',
        '香港'                                   => 'HK',
        'オーストラリア'                         => 'AU',
        'タイ'                                   => 'TH',
        '英国'                                   => 'GB',
        'シンガポール'                           => 'SG',
        'アイスランド'                           => 'IS',
        'アイルランド'                           => 'IE',
        'アゼルバイジャン'                       => 'AZ',
        'アセンション'                           => 'AC',
        'アフガニスタン'                         => 'AF',
        'アラブ首長国連邦'                       => 'AE',
        'アルジェリア'                           => 'DZ',
        'アルゼンチン'                           => 'AR',
        'アルバ'                                 => 'AW',
        'アルバニア'                             => 'AL',
        'アルメニア'                             => 'AM',
        'アンギラ'                               => 'AI',
        'アンゴラ'                               => 'AO',
        'アンティグア・バーブーダ'               => 'AG',
        'アンドラ'                               => 'AD',
        'イエメン'                               => 'YE',
        'イスラエル'                             => 'IL',
        'イタリア'                               => 'IT',
        'イラク'                                 => 'IQ',
        'イラン'                                 => 'IR',
        'インド'                                 => 'IN',
        'インドネシア'                           => 'ID',
        'ウェーキ'                               => 'UM',
        'ウガンダ'                               => 'UG',
        'ウクライナ'                             => 'UA',
        'ウズベキスタン'                         => 'UZ',
        'ウルグアイ'                             => 'UY',
        '英領ヴァージン諸島'                     => 'VG',
        'エクアドル'                             => 'EC',
        'エジプト'                               => 'EG',
        'エストニア'                             => 'EE',
        'エスワティニ'                           => 'SZ',
        'エチオピア'                             => 'ET',
        'エリトリア'                             => 'ER',
        'エルサルバドル'                         => 'SV',
        'オーストリア'                           => 'AT',
        'オマーン'                               => 'OM',
        'オランダ'                               => 'NL',
        'オランダカリブ領域'                     => 'BQ',
        'ガーナ'                                 => 'GH',
        'カーボベルデ'                           => 'CV',
        'ガーンジー'                             => 'GG',
        'ガイアナ'                               => 'GY',
        'カザフスタン'                           => 'KZ',
        'カタール'                               => 'QA',
        'ガドループ'                             => 'GP',
        'カナダ'                                 => 'CA',
        'ガボン'                                 => 'GA',
        'カメルーン'                             => 'CM',
        'ガンビア'                               => 'GM',
        'カンボジア'                             => 'KH',
        '北朝鮮'                                 => 'KP',
        '北マケドニア'                           => 'MK',
        '北マリアナ諸島'                         => 'MP',
        'ギニア'                                 => 'GN',
        'ギニアビサウ'                           => 'GW',
        'キプロス'                               => 'CY',
        'キューバ'                               => 'CU',
        'キュラソー'                             => 'CW',
        'ギリシャ'                               => 'GR',
        'キリバス'                               => 'KI',
        'キルギス'                               => 'KG',
        'グアテマラ'                             => 'GT',
        'グアム'                                 => 'GU',
        'クウェート'                             => 'KW',
        'クック'                                 => 'CK',
        'グリーンランド'                         => 'GL',
        'クリスマス島'                           => 'CX',
        'グレナダ'                               => 'GD',
        'クロアチア'                             => 'HR',
        'ケイマン諸島'                           => 'KY',
        'ケニア'                                 => 'KE',
        'コートジボワール'                       => 'CI',
        'ココス（キーリング）諸島'               => 'CC',
        'コスタリカ'                             => 'CR',
        'コソボ'                                 => 'XK',
        'コモロ'                                 => 'KM',
        'コロンビア'                             => 'CO',
        'コンゴ共和国'                           => 'CG',
        'コンゴ民主共和国'                       => 'CD',
        'サイパン'                               => 'SP',
        'サウジアラビア'                         => 'SA',
        'サモア'                                 => 'WS',
        'サントメ・プリンシペ'                   => 'ST',
        'ザンビア'                               => 'ZM',
        'サンピエールおよびミクロン'             => 'PM',
        'サンマリノ'                             => 'SM',
        'シエラレオネ'                           => 'SL',
        'ジブチ'                                 => 'DJ',
        'ジブラルタル'                           => 'GI',
        'ジャージー'                             => 'JE',
        'ジャマイカ'                             => 'JM',
        'ジョージア'                             => 'GE',
        'シリア'                                 => 'SY',
        'シント・マールテン'                     => 'SX',
        'ジンバブエ'                             => 'ZW',
        'スイス'                                 => 'CH',
        'スウェーデン'                           => 'SE',
        'スーダン'                               => 'SD',
        'スペイン'                               => 'ES',
        'スリナム'                               => 'SR',
        'スリランカ'                             => 'LK',
        'スロバキア'                             => 'SK',
        'スロベニア'                             => 'SI',
        'セーシェル'                             => 'SC',
        '赤道ギニア'                             => 'GQ',
        'セネガル'                               => 'SN',
        'セルビア'                               => 'RS',
        'セント・ヘレナ'                         => 'SH',
        'セントクリストファー・ネービス'         => 'KN',
        'セントビンセント'                       => 'VC',
        'セントルシア'                           => 'LC',
        'ソマリア'                               => 'SO',
        'ソロモン'                               => 'SB',
        'タークスおよびカイコス諸島'             => 'TC',
        'タジキスタン'                           => 'TJ',
        'タンザニア'                             => 'TZ',
        'チェコ'                                 => 'CZ',
        'チャド'                                 => 'TD',
        '中央アフリカ'                           => 'CF',
        'チュニジア'                             => 'TN',
        'チリ'                                   => 'CL',
        'ツバル'                                 => 'TV',
        'デンマーク'                             => 'DK',
        'ドイツ'                                 => 'DE',
        'トーゴ'                                 => 'TG',
        'ドミニカ'                               => 'DM',
        'ドミニカ共和国'                         => 'DO',
        'トリスタン・ダ・クーニャ'               => 'TA',
        'トリニダード・トバゴ'                   => 'TT',
        'トルクメニスタン'                       => 'TM',
        'トルコ'                                 => 'TR',
        'トンガ'                                 => 'TO',
        'ナイジェリア'                           => 'NG',
        'ナウル'                                 => 'NR',
        'ナミビア'                               => 'NA',
        '南極におけるフランスの地域'             => 'TF',
        'ニカラグア'                             => 'NI',
        'ニジェール'                             => 'NE',
        'ニュー・カレドニア'                     => 'NC',
        'ニュージーランド'                       => 'NZ',
        'ネパール'                               => 'NP',
        'ノーフォーク島'                         => 'NF',
        'ノルウェー'                             => 'NO',
        'バーミュダ諸島'                         => 'BM',
        'バーレーン'                             => 'BH',
        'ハイチ'                                 => 'HT',
        'パキスタン'                             => 'PK',
        'バチカン'                               => 'VA',
        'パナマ'                                 => 'PA',
        'バヌアツ'                               => 'VU',
        'バハマ'                                 => 'BS',
        'パプアニューギニア'                     => 'PG',
        'パラオ'                                 => 'PW',
        'パラグアイ'                             => 'PY',
        'バルバドス'                             => 'BB',
        'ハンガリー'                             => 'HU',
        'バングラデシュ'                         => 'BD',
        '東ティモール'                           => 'TL',
        'ピトケアン'                             => 'PN',
        'フィジー'                               => 'FJ',
        'フィンランド'                           => 'FI',
        'ブータン'                               => 'BT',
        'プエルト・リコ'                         => 'PR',
        'フェロー島'                             => 'FO',
        'フォークランド諸島（マルヴィナス諸島）' => 'FK',
        '仏領ギアナ'                             => 'GF',
        '仏領ポリネシア'                         => 'PF',
        'ブラジル'                               => 'BR',
        'フランス'                               => 'FR',
        'ブルガリア'                             => 'BG',
        'ブルキナファソ'                         => 'BF',
        'ブルネイ'                               => 'BN',
        'ブルンジ'                               => 'BI',
        '米領ヴァージン諸島'                     => 'VI',
        '米領サモア'                             => 'AS',
        'ベトナム'                               => 'VN',
        'ベナン'                                 => 'BJ',
        'ベネズエラ'                             => 'VE',
        'ベラルーシ'                             => 'BY',
        'ベリーズ'                               => 'BZ',
        'ペルー'                                 => 'PE',
        'ベルギー'                               => 'BE',
        'ポーランド'                             => 'PL',
        'ボスニア・ヘルツェゴビナ'               => 'BA',
        '北方諸島'                               => 'JP',
        'ボツワナ'                               => 'BW',
        'ボリビア'                               => 'BO',
        'ポルトガル'                             => 'PT',
        'ホンジュラス'                           => 'HN',
        'マーシャル'                             => 'MH',
        'マカオ'                                 => 'MO',
        'マダガスカル'                           => 'MG',
        'マラウイ'                               => 'MW',
        'マリ'                                   => 'ML',
        'マルタ'                                 => 'MT',
        'マルチニーク'                           => 'MQ',
        'マレーシア'                             => 'MY',
        'マン島'                                 => 'IM',
        'ミクロネシア'                           => 'FM',
        'ミッドウェイ諸島'                       => 'MI',
        '南アフリカ共和国'                       => 'ZA',
        '南スーダン'                             => 'SS',
        'ミャンマー'                             => 'MM',
        'メキシコ'                               => 'MX',
        'モーリシャス'                           => 'MU',
        'モーリタニア'                           => 'MR',
        'モザンビーク'                           => 'MZ',
        'モナコ'                                 => 'MC',
        'モルディブ'                             => 'MV',
        'モルドバ'                               => 'MD',
        'モロッコ'                               => 'MA',
        'モンゴル'                               => 'MN',
        'モンテネグロ'                           => 'ME',
        'モントセラト'                           => 'MS',
        'ヨルダン'                               => 'JO',
        'ラオス'                                 => 'LA',
        'ラトビア'                               => 'LV',
        'リトアニア'                             => 'LT',
        'リビア'                                 => 'LY',
        'リヒテンシュタイン'                     => 'LI',
        'リベリア'                               => 'LR',
        'ルーマニア'                             => 'RO',
        'ルクセンブルク'                         => 'LU',
        'ルワンダ'                               => 'RW',
        'レソト'                                 => 'LS',
        'レバノン'                               => 'LB',
        'レユニオン'                             => 'RE',
        'ロシア'                                 => 'RU',
        'ワリスおよびフツナ'                     => 'WF',
    ],
];
