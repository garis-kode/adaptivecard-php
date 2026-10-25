<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum GaugeValueFormat: string
{
    case Percentage = 'Percentage';
    case Fraction = 'Fraction';
}
