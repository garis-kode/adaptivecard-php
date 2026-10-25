<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ActionBehavior: string
{
    case Default = 'Default';
    case Toggle = 'Toggle';
}
