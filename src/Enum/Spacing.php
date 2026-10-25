<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum Spacing: string
{
    case Default = 'Default';
    case None = 'None';
    case ExtraSmall = 'ExtraSmall';
    case Small = 'Small';
    case Medium = 'Medium';
    case Large = 'Large';
    case ExtraLarge = 'ExtraLarge';
    case Padding = 'Padding';
}
