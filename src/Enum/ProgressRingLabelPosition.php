<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ProgressRingLabelPosition: string
{
    case Before = 'Before';
    case After = 'After';
    case Above = 'Above';
    case Below = 'Below';
}
