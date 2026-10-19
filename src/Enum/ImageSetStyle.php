<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ImageSetStyle: string
{
    use EnumValue;

    case Default = 'default';
    case Stacked = 'stacked';
    case Grid = 'grid';
}
