<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

/**
 * Reference for individual chart color identifiers and the hex values of the supported color sets.
 */
enum ChartColorSet: string
{
    case Categorical = 'categorical';
    case Diverging = 'diverging';
    case Sequential = 'sequential';
    case SequentialRed = 'sequentialred';
    case SequentialGreen = 'sequentialgreen';
    case SequentialYellow = 'sequentialyellow';
}
