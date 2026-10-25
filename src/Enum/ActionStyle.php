<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ActionStyle: string
{
    case Default = 'default';
    case Positive = 'positive';
    case Destructive = 'destructive';
}
