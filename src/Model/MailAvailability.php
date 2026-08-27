<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Model;

use Sunaoka\JapanPostInternationalMail\Resolver\DeliveryStatusResolver;

final readonly class MailAvailability implements \JsonSerializable
{
    private function __construct(private string $air, private string $sal, private string $surface) {}

    #[\NoDiscard]
    public static function make(string $air, string $sal, string $surface): self
    {
        $mapper = new DeliveryStatusResolver();

        return new self(
            $mapper->map($air),
            $mapper->map($sal),
            $mapper->map($surface),
        );
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
