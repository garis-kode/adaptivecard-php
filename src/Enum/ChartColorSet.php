<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

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
