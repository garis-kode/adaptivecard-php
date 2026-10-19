<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ImageSize: string
{
    use EnumValue;

    case Auto = 'auto';
    case Stretch = 'stretch';
    case Small = 'small';
    case Medium = 'medium';
    case Large = 'large';
}
