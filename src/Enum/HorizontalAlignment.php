<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum HorizontalAlignment: string
{
    use EnumValue;

    case Left = 'left';
    case Center = 'center';
    case Right = 'right';
}
