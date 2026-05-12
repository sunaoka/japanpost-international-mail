<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use Sunaoka\JapanPostInternationalMail\Destination\Mail;

use function Sunaoka\JapanPostInternationalMail\Support\config;

class Destination implements \JsonSerializable
{
    use Traits\CountryCode;

    public string $countryCode;

    public string $destination;

    private Mail $letterPost;

    private Mail $parcels;

    private string $ems;

    private array $restrictions;

    private string $notification;

    private function __construct(Language $language, array $attributes)
    {
        $this->countryCode = $this->getCountryCode($language, $attributes[0]);
        $this->destination = $attributes[0];
        $this->letterPost = Mail::make($language, $attributes[1], $attributes[2], $attributes[3]);
        $this->parcels = Mail::make($language, $attributes[4], $attributes[5], $attributes[6]);
        $this->ems = config("{$language->value}.delivery")[$attributes[7]];

        // Backward compatibility
        $this->restrictions = [
            'normal' => [],
            'temporary' => [],
            'delays' => [],
        ];
        $this->notification = '';
    }

    #[\NoDiscard]
    public static function make(Language $language, array $attributes): self
    {
        return new self($language, $attributes);
    }

    public function jsonSerialize(): array
    {
        return [
            'countryCode'  => $this->countryCode,
            'destination'  => $this->destination,
            'letterPost'   => $this->letterPost,
            'parcels'      => $this->parcels,
            'ems'          => $this->ems,
            'restrictions' => $this->restrictions,
            'notification' => $this->notification,
        ];
    }
}
