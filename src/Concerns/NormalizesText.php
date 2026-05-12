<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail\Concerns;

trait NormalizesText
{
    public function normalize(string $string): string
    {
        $str = \Normalizer::normalize($string);
        if ($str === false) {
            throw new \RuntimeException('Failed to normalize string.');
        }

        return str_replace("\u{00A0}", '', $str)  // no-break space (&nbsp;)
                |> trim(...);
    }
}
