<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use JsonSerializable;
use OutOfRangeException;
use Sunaoka\JapanPostInternationalMail\Destination\Mail;
use Sunaoka\JapanPostInternationalMail\Destination\Restrictions;

class Destination implements JsonSerializable
{
    private string $countryCode;

    private string $destination;

    private Mail $letterPost;

    private Mail $parcels;

    private string $ems;

    private Restrictions $restrictions;

    private string $notification;

    private function __construct(Language $language, array $attributes)
    {
        $this->countryCode = $this->getCountryCode($language, $attributes[1]);
        $this->destination = $attributes[1];
        $this->letterPost = Mail::make($language, $attributes[2], $attributes[3], $attributes[4]);
        $this->parcels = Mail::make($language, $attributes[5], $attributes[6], $attributes[7]);
        $this->ems = config("{$language->getValue()}.delivery")[$attributes[8]];
        $this->restrictions = Restrictions::make($language, $attributes[9]);
        $this->notification = $attributes[10];
    }

    public static function make(Language $language, array $attributes): self
    {
        return new self($language, $attributes);
    }

    private function getCountryCode(Language $language, string $destination): string
    {
        $countries = config("{$language->getValue()}.countries");
        if (!isset($countries[$destination])) {
            throw new OutOfRangeException("No such country '{$destination}' in {$language->getValue()}");
        }

        return $countries[$destination];
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
