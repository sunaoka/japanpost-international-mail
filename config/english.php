<?php

declare(strict_types=1);

return [
    'uri'          => 'https://www.post.japanpost.jp/int/information/overview_en.html',
    'delivery'     => [
        '✔' => 'acceptable',
        '✓'  => 'acceptable',
        '*'  => 'some_acceptable',
        'X'  => 'not_acceptable',
        '-'  => 'no_service',
    ],
    'restrictions' => [
        '(N)' => 'normal',
        '(T)' => 'temporary',
        '(D)' => 'delays',
        '（N）' => 'normal',
        '（T）' => 'temporary',
        '（D）' => 'delays',
        '(N）' => 'normal',
        '(T）' => 'temporary',
        '(D）' => 'delays',
        '（N)' => 'normal',
        '（T)' => 'temporary',
        '（D)' => 'delays',
    ],
    'period'       => '.',
    'file'         => 'en.json',
    'countries'    => [
        'China'                                                => 'CN',
        'United States of America'                             => 'US',
        'Republic of Korea'                                    => 'KR',
        'Philippines'                                          => 'PH',
        'Taiwan'                                               => 'TW',
        'Hong Kong'                                            => 'HK',
        'Australia'                                            => 'AU',
        'Thailand'                                             => 'TH',
        'United Kingdom of Great Britain and Northern Ireland' => 'GB',
        'Singapore'                                            => 'SG',
        'Iceland'                                              => 'IS',
        'Ireland'                                              => 'IE',
        'Azerbaijan'                                           => 'AZ',
        'Ascension'                                            => 'AX',
        'Afghanistan'                                          => 'AF',
        'United Arab Emirates'                                 => 'AE',
        'Algeria'                                              => 'DZ',
        'Argentina'                                            => 'AR',
        'Aruba'                                                => 'AW',
        'Albania'                                              => 'AL',
        'Armenia'                                              => 'AM',
        'Anguilla'                                             => 'AI',
        'Angola'                                               => 'AO',
        'Antigua and Barbuda'                                  => 'AG',
        'Andorra'                                              => 'AD',
        'Yemen'                                                => 'YE',
        'Israel'                                               => 'IL',
        'Italy'                                                => 'IT',
        'Iraq'                                                 => 'IQ',
        'Iran'                                                 => 'IR',
        'India'                                                => 'IN',
        'Indonesia'                                            => 'ID',
        'Wake Island'                                          => 'WK',
        'Uganda'                                               => 'UG',
        'Ukraine'                                              => 'UA',
        'Uzbekistan'                                           => 'UZ',
        'Uruguay'                                              => 'UY',
        'British Virgin Islands'                               => 'VG',
        'Ecuador'                                              => 'EC',
        'Egypt'                                                => 'EG',
        'Estonia'                                              => 'EE',
        'Eswatini'                                             => 'SZ',
        'Ethiopia'                                             => 'ET',
        'Eritrea'                                              => 'ER',
        'El Salvador'                                          => 'SV',
        'Austria'                                              => 'AT',
        'Oman'                                                 => 'OM',
        'Netherlands'                                          => 'NL',
        'Bonaire, Saba and Sint Eustatius'                     => 'BQ',
        'Ghana'                                                => 'GH',
        'Cape Verde'                                           => 'CV',
        'Guernsey'                                             => 'GG',
        'Guyana'                                               => 'GY',
        'Kazakhstan'                                           => 'KZ',
        'Qatar'                                                => 'QA',
        'Guadeloupe'                                           => 'GP',
        'Canada'                                               => 'CA',
        'Gabon'                                                => 'GA',
        'Cameroon'                                             => 'CM',
        'Gambia'                                               => 'GM',
        'Cambodia'                                             => 'KH',
        'North Korea'                                          => 'KP',
        'North Macedonia'                                      => 'MK',
        'Northern Mariana Islands'                             => 'MP',
        'Guinea'                                               => 'GN',
        'Guinea-Bissau'                                        => 'GW',
        'Cyprus'                                               => 'CY',
        'Cuba'                                                 => 'CU',
        'Curacao'                                              => 'CW',
        'Greece'                                               => 'GR',
        'Kiribati'                                             => 'KI',
        'Kyrgyz'                                               => 'KG',
        'Guatemala'                                            => 'GT',
        'Guam'                                                 => 'GU',
        'Kuwait'                                               => 'KW',
        'Cook Islands'                                         => 'CK',
        'Greenland'                                            => 'GL',
        'Christmas Island'                                     => 'CX',
        'Grenada'                                              => 'GD',
        'Croatia'                                              => 'HR',
        'Cayman Islands'                                       => 'KY',
        'Kenya'                                                => 'KE',
        'Ivory Coast'                                          => 'CI',
        'Cocos (Keeling) Islands'                              => 'CC',
        'Costa Rica'                                           => 'CR',
        'Kosovo'                                               => 'XZ',
        'Comoros Islands'                                      => 'KM',
        'Colombia'                                             => 'CO',
        'Congo'                                                => 'CG',
        'The Democratic Republic of the Congo'                 => 'CD',
        'Saipan'                                               => 'SP',
        'Saudi Arabia'                                         => 'SA',
        'Independent State of Samoa'                           => 'WS',
        'Sao Tome and Principe'                                => 'ST',
        'Zambia'                                               => 'ZM',
        'St. Pierre and Miquelon'                              => 'PM',
        'San Marino'                                           => 'SM',
        'Sierra Leone'                                         => 'SL',
        'Djibouti'                                             => 'DJ',
        'Gibraltar'                                            => 'GI',
        'Jersey'                                               => 'JE',
        'Jamaica'                                              => 'JM',
        'Georgia'                                              => 'GE',
        'Syria'                                                => 'SY',
        'Saint Maarten'                                        => 'SX',
        'Zimbabwe'                                             => 'ZW',
        'Switzerland'                                          => 'CH',
        'Sweden'                                               => 'SE',
        'Sudan'                                                => 'SD',
        'Spain'                                                => 'ES',
        'Suriname'                                             => 'SR',
        'Sri Lanka'                                            => 'LK',
        'Slovakia'                                             => 'SK',
        'Slovenia'                                             => 'SI',
        'Seychelles'                                           => 'SC',
        'Equatorial Guinea'                                    => 'GQ',
        'Senegal'                                              => 'SN',
        'Serbia'                                               => 'RS',
        'St. Helena'                                           => 'SH',
        'Saint Christopher and Nevis'                          => 'KN',
        'Saint Vincent'                                        => 'VC',
        'Saint Lucia'                                          => 'LC',
        'Somalia'                                              => 'SO',
        'Solomon Islands'                                      => 'SB',
        'Turks and Caicos'                                     => 'TC',
        'Tajikistan'                                           => 'TJ',
        'Tanzania (United Rep.)'                               => 'TZ',
        'Czech Republic'                                       => 'CZ',
        'Chad'                                                 => 'TD',
        'Central Africa'                                       => 'CF',
        'Tunisia'                                              => 'TN',
        'Chile'                                                => 'CL',
        'Tuvalu'                                               => 'TV',
        'Denmark'                                              => 'DK',
        'Germany'                                              => 'DE',
        'Togo'                                                 => 'TG',
        'Dominica'                                             => 'DM',
        'Dominican Republic'                                   => 'DO',
        'Tristan da Cunha'                                     => 'TA',
        'Trinidad and Tobago'                                  => 'TT',
        'Turkmenistan'                                         => 'TM',
        'Turkey'                                               => 'TR',
        'Tonga'                                                => 'TO',
        'Nigeria'                                              => 'NG',
        'Nauru'                                                => 'NR',
        'Namibia'                                              => 'NA',
        'French Southern and Antarctic Territories'            => 'TF',
        'Nicaragua'                                            => 'NI',
        'Niger'                                                => 'NE',
        'New Caledonia'                                        => 'NC',
        'New Zealand'                                          => 'NZ',
        'Nepal'                                                => 'NP',
        'Norfolk Island'                                       => 'NF',
        'Norway'                                               => 'NO',
        'Bermuda'                                              => 'BM',
        'Bahrain'                                              => 'BH',
        'Haiti'                                                => 'HT',
        'Pakistan'                                             => 'PK',
        'Vatican'                                              => 'VA',
        'Panama'                                               => 'PA',
        'Vanuatu'                                              => 'VU',
        'Bahamas'                                              => 'BS',
        'Papua New Guinea'                                     => 'PG',
        'Palau'                                                => 'PW',
        'Paraguay'                                             => 'PY',
        'Barbados'                                             => 'BB',
        'Hungary'                                              => 'HU',
        'Bangladesh'                                           => 'BD',
        'East Timor'                                           => 'TL',
        'Pitcairn'                                             => 'PN',
        'Fiji'                                                 => 'FJ',
        'Finland'                                              => 'FI',
        'Bhutan'                                               => 'BT',
        'Puerto Rico'                                          => 'PR',
        'Faroe Islands'                                        => 'FO',
        'Falkland'                                             => 'FK',
        'French Guiana'                                        => 'GF',
        'French Polynesia'                                     => 'PF',
        'Brazil'                                               => 'BR',
        'France'                                               => 'FR',
        'Bulgaria'                                             => 'BG',
        'Burkina Faso'                                         => 'BF',
        'Brunei'                                               => 'BN',
        'Burundi'                                              => 'BI',
        'Virgin Islands'                                       => 'VI',
        'American Samoa'                                       => 'AS',
        'Viet Nam'                                             => 'VN',
        'Benin'                                                => 'BJ',
        'Venezuela'                                            => 'VE',
        'Belarus'                                              => 'BY',
        'Belize'                                               => 'BZ',
        'Peru'                                                 => 'PE',
        'Belgium'                                              => 'BE',
        'Poland'                                               => 'PL',
        'Bosnia and Herzegovina'                               => 'BA',
        'North Islands'                                        => 'NT',
        'Botswana'                                             => 'BW',
        'Bolivia'                                              => 'BO',
        'Portugal'                                             => 'PT',
        'Honduras'                                             => 'HN',
        'Marshall Islands'                                     => 'MH',
        'Macao'                                                => 'MO',
        'Madagascar'                                           => 'MG',
        'Malawi'                                               => 'MW',
        'Mali'                                                 => 'ML',
        'Malta'                                                => 'MT',
        'Martinique'                                           => 'MQ',
        'Malaysia'                                             => 'MY',
        'Isle of Man'                                          => 'IM',
        'Federated States of Micronesia'                       => 'FM',
        'Midway Islands'                                       => 'UM',
        'South Africa'                                         => 'ZA',
        'South Sudan'                                          => 'SS',
        'Myanmar'                                              => 'MM',
        'Mexico'                                               => 'MX',
        'Mauritius'                                            => 'MU',
        'Mauritania'                                           => 'MR',
        'Mozambique'                                           => 'MZ',
        'Monaco'                                               => 'MC',
        'Maldives'                                             => 'MV',
        'Moldova'                                              => 'MD',
        'Morocco'                                              => 'MA',
        'Mongolia'                                             => 'MN',
        'Montenegro'                                           => 'ME',
        'Montserrat'                                           => 'MS',
        'Jordan'                                               => 'JO',
        'Lao People\'s Democratic Republic'                    => 'LA',
        'Latvia'                                               => 'LV',
        'Lithuania'                                            => 'LT',
        'Libya'                                                => 'LY',
        'Liechtenstein'                                        => 'LI',
        'Liberia'                                              => 'LR',
        'Romania'                                              => 'RO',
        'Luxembourg'                                           => 'LU',
        'Rwanda'                                               => 'RW',
        'Lesotho'                                              => 'LS',
        'Lebanon'                                              => 'LB',
        'Reunion'                                              => 'RE',
        'Russian Federation'                                   => 'RU',
        'Wallis and Futuna'                                    => 'WF',
    ],
];
