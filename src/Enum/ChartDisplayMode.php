<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ChartDisplayMode: string
{
    case AbsoluteWithAxis = 'AbsoluteWithAxis';
    case AbsoluteNoAxis = 'AbsoluteNoAxis';
    case PartToWhole = 'PartToWhole';
}
