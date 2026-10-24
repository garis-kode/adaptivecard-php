<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

/**
 * Reference for individual chart color identifiers and the hex values of the supported color sets.
 */
enum ChartColorSet: string
{
    use EnumValue;

    case Categorical = 'categorical';
    case Diverging = 'diverging';
    case Sequential = 'sequential';
    case SequentialRed = 'sequentialRed';
    case SequentialGreen = 'sequentialGreen';
    case SequentialYellow = 'sequentialYellow';
}
