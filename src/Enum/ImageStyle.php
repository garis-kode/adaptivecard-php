<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ImageStyle: string
{
    use EnumValue;

    case Default = 'default';
    case Person = 'person';
    case RoundedCorners = 'RoundedCorners';
}
