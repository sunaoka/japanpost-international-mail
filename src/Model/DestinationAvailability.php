<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Model;

use Sunaoka\JapanPostInternationalMail\Resolver\DeliveryStatusResolver;

final class DestinationAvailability implements \JsonSerializable
{
    private function __construct(
        public string $countryCode,
        public string $destination,
        private readonly MailAvailability $letterPost,
        private readonly MailAvailability $parcels,
        private readonly string $ems,
    ) {}

    #[\NoDiscard]
    public static function make(
        string $countryCode,
        string $destination,
        string $letterAir,
        string $letterSal,
        string $letterSurface,
        string $parcelAir,
        string $parcelSal,
        string $parcelSurface,
        string $ems,
    ): self {
        $mapper = new DeliveryStatusResolver();

        return new self(
            $countryCode,
            $destination,
            MailAvailability::make($letterAir, $letterSal, $letterSurface),
            MailAvailability::make($parcelAir, $parcelSal, $parcelSurface),
            $mapper->map($ems),
        );
    }

    #[\NoDiscard]
    public function withLocalizedDestination(string $destination): self
    {
        return clone($this, [
            'destination' => $destination,
        ]);
    }

    public function jsonSerialize(): array
    {
        return [
            'countryCode'  => $this->countryCode,
            'destination'  => $this->destination,
            'letterPost'   => $this->letterPost,
            'parcels'      => $this->parcels,
            'ems'          => $this->ems,
            'restrictions' => [
                'normal'    => [],
                'temporary' => [],
                'delays'    => [],
            ],
            'notification' => '',
        ];
    }
}
