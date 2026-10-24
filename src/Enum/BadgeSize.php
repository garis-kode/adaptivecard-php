<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum BadgeSize: string
{
    use EnumValue;

    case Medium = 'Medium';
    case Large = 'Large';
    case ExtraLarge = 'ExtraLarge';
}
