<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum IconStyle: string
{
    use EnumValue;

    case Regular = 'Regular';
    case Filled = 'Filled';
}
