<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum RatingSize: string
{
    use EnumValue;

    case Medium = 'Medium';
    case Large = 'Large';
}
