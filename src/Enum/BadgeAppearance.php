<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum BadgeAppearance: string
{
    use EnumValue;

    case Filled = 'Filled';
    case Tint = 'Tint';
}
