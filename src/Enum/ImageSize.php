<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ImageSize: string
{
    case Auto = 'Auto';
    case Stretch = 'Stretch';
    case Small = 'Small';
    case Medium = 'Medium';
    case Large = 'Large';
}
