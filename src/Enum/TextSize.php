<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum TextSize: string
{
    case Default = 'default';
    case Small = 'small';
    case Medium = 'medium';
    case Large = 'large';
    case ExtraLarge = 'extraLarge';
}
