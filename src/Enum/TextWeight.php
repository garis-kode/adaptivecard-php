<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum TextWeight: string
{
    use EnumValue;

    case Default = 'default';
    case Lighter = 'lighter';
    case Bolder = 'bolder';
}
