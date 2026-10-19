<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ChoiceInputStyle: string
{
    use EnumValue;

    case Compact = 'compact';
    case Expanded = 'expanded';
    case Filtered = 'filtered';
}
