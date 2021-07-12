<?php

declare(strict_types=1);

namespace Sunaoka\JapanPostInternationalMail;

use MyCLabs\Enum\Enum;

/**
 * @method static JAPANESE()
 * @method static ENGLISH()
 * @method static CHINESE()
 */
class Language extends Enum
{
    private const JAPANESE = 'japanese';

    private const ENGLISH = 'english';

    private const CHINESE = 'chinese';
}
