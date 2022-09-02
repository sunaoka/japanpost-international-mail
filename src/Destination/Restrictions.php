<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Destination;

use JsonSerializable;
use Sunaoka\JapanPostInternationalMail\Language;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Restrictions implements JsonSerializable
{
    private array $normal = [];

    private array $temporary = [];

    private array $delays = [];

    private function __construct(Language $language, ?string $restriction)
    {
        $restrictions = config("{$language->value}.restrictions");

        $regex = array_map(static fn($x) => preg_quote($x, '/'), array_keys($restrictions));

        $items = preg_split('/(' . implode('|', $regex) . ')/', $restriction, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        for ($i = 0, $len = count($items); $i < $len; $i += 2) {
            $this->{$restrictions[$items[$i]]}[] = $this->normalize($language, $items[$i + 1]);
        }
    }

    /**
     * @param Language    $language
     * @param string|null $restriction
     *
     * @return static
     */
    public static function make(Language $language, ?string $restriction): self
    {
        return new self($language, $restriction);
    }

    private function normalize(Language $language, string $string): string
    {
        $string = trim($string);

        $period = config("{$language->value}.period");
        if (str_ends_with($string, $period) === false) {
            $string .= $period;
        }

        return $string;
    }

    public function jsonSerialize(): array
    {
        return [
            'normal'    => $this->normal,
            'temporary' => $this->temporary,
            'delays'    => $this->delays,
        ];
    }
}
