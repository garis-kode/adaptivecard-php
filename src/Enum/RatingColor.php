<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum RatingColor: string
{
    use EnumValue;

    case Neutral = 'Neutral';
    case Marigold = 'Marigold';
}
