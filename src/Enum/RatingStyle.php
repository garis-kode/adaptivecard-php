<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum RatingStyle: string
{
    use EnumValue;

    case Default = 'Default';
    case Compact = 'Compact';
}
