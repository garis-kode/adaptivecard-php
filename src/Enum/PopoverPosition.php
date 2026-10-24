<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum PopoverPosition: string
{
    case Above = 'Above';
    case Below = 'Below';
    case Before = 'Before';
    case After = 'After';
}
