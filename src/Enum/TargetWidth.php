<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum TargetWidth: string
{
    case VeryNarrow = 'VeryNarrow';
    case Narrow = 'Narrow';
    case Standard = 'Standard';
    case Wide = 'Wide';
    case AtLeastVeryNarrow = 'atLeast:VeryNarrow';
    case AtMostVeryNarrow = 'atMost:VeryNarrow';
    case AtLeastNarrow = 'atLeast:Narrow';
    case AtMostNarrow = 'atMost:Narrow';
    case AtLeastStandard = 'atLeast:Standard';
    case AtMostStandard = 'atMost:Standard';
    case AtLeastWide = 'atLeast:Wide';
    case AtMostWide = 'atMost:Wide';
}
