<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Destination;

use JsonSerializable;
use Sunaoka\JapanPostInternationalMail\Language;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Mail implements JsonSerializable
{
    private function __construct(Language $language, private string $air, private string $sal, private string $surface)
    {
        $delivery = config("{$language->value}.delivery");

        $this->air = $delivery[$air];
        $this->sal = $delivery[$sal];
        $this->surface = $delivery[$surface];
    }

    /**
     * @param Language $language
     * @param string   $air
     * @param string   $sal
     * @param string   $surface
     *
     * @return static
     */
    public static function make(Language $language, string $air, string $sal, string $surface): self
    {
        return new self($language, $air, $sal, $surface);
    }

    public function jsonSerialize(): array
    {
        return [
            'air'     => $this->air,
            'sal'     => $this->sal,
            'surface' => $this->surface,
        ];
    }
}
