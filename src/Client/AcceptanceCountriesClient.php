<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Client;

use Symfony\Component\HttpClient\HttpClient;

final class AcceptanceCountriesClient
{
    private const string URI = 'https://www.post.japanpost.jp/service/send/oversea/information/json/acceptance_countries.json';

    private const int COUNTRY_COUNT = 240;

    private const array REQUIRED_FIELDS = [
        '国名',
        '英語表記',
        '読み',
        '通常郵便物の航空扱い',
        '通常郵便物のSAL扱い',
        '通常郵便物の船便扱い',
        '小包郵便物の航空扱い',
        '小包郵便物のSAL扱い',
        '小包郵便物の船便扱い',
        'EMS',
        '通関電子データ送信',
        'cid',
    ];

    /**
     * @return array<int, array<string, int|string>>
     */
    #[\NoDiscard]
    public function fetch(): array
    {
        $contents = HttpClient::create()->request('GET', self::URI)->getContent();

        try {
            $countries = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \RuntimeException('Invalid acceptance countries JSON.', previous: $e);
        }

        if (!is_array($countries) || !array_is_list($countries)) {
            throw new \RuntimeException('Acceptance countries JSON must be a list.');
        }

        if (count($countries) !== self::COUNTRY_COUNT) {
            throw new \RuntimeException(sprintf('Expected %d acceptance countries, got %d.', self::COUNTRY_COUNT, count($countries)));
        }

        foreach ($countries as $index => $country) {
            if (!is_array($country)) {
                throw new \RuntimeException("Acceptance country {$index} must be an object.");
            }

            foreach (self::REQUIRED_FIELDS as $field) {
                if (!array_key_exists($field, $country)) {
                    throw new \RuntimeException("Acceptance country {$index} is missing '{$field}'.");
                }
            }

            foreach (array_diff(self::REQUIRED_FIELDS, ['cid']) as $field) {
                if (!is_string($country[$field])) {
                    throw new \RuntimeException("Acceptance country {$index} has an invalid '{$field}'.");
                }
            }

            if (!is_int($country['cid'])) {
                throw new \RuntimeException("Acceptance country {$index} has an invalid 'cid'.");
            }
        }

        return $countries;
    }
}
