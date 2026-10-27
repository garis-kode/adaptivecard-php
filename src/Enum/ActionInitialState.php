<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ActionInitialState: string
{
    case Normal = 'Normal';
    case Toggled = 'Toggled';
}
