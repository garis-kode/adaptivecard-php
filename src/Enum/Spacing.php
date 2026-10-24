<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum Spacing: string
{
    use EnumValue;

    case Default = 'default';
    case None = 'none';
    case ExtraSmall = 'extraSmall';
    case Small = 'small';
    case Medium = 'medium';
    case Large = 'large';
    case ExtraLarge = 'extraLarge';
    case Padding = 'padding';
}
