<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum BadgeShape: string
{
    use EnumValue;

    case Square = 'Square';
    case Rounded = 'Rounded';
    case Circular = 'Circular';
}
