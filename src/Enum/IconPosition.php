<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum IconPosition: string
{
    use EnumValue;

    case Before = 'Before';
    case After = 'After';
}
