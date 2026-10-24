<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ChoiceInputStyle: string
{
    case Compact = 'compact';
    case Expanded = 'expanded';
    case Filtered = 'filtered';
}
